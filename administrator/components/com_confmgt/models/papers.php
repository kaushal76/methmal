<?php

/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Confmgt records.
 */
class ConfmgtModelPapers extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'title', 'a.title',
                'abstract', 'a.abstract',
                'keywords', 'a.keywords',
                'ordering', 'a.ordering',
                'state', 'a.state',
                'created_by', 'a.created_by',
                'full_paper', 'a.full_paper',
                'camera_ready', 'a.camera_ready',
                'presentation', 'a.presentation',
                'full_review_outcome', 'a.full_review_outcome',
                'abstract_review_outcome', 'a.abstract_review_outcome',
                'full_review_comments', 'a.full_review_comments',
                'abstract_review_comments', 'a.abstract_review_comments',

            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

        

        // Load the parameters.
        $params = JComponentHelper::getParams('com_confmgt');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.id', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );
        $query->from('`#__confmgt_papers` AS a');

        
		// Join over the users for the checked out user
		$query->select("uc.name AS editor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");
		// Join over the user field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');

        

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.state = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(a.state IN (0, 1))');
		}

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                
            }
        }

        


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();
        
		foreach ($items as $oneItem) {

			if (isset($oneItem->full_review_outcome)) {
				$values = explode(',', $oneItem->full_review_outcome);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = "select name, value from #__confmgt_review_outcomes WHERE value LIKE '" . $value . "'";
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$oneItem->full_review_outcome = !empty($textValue) ? implode(', ', $textValue) : $oneItem->full_review_outcome;

			}

			if (isset($oneItem->abstract_review_outcome)) {
				$values = explode(',', $oneItem->abstract_review_outcome);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = "SELECT value, name FROM #__confmgt_review_outcomes  WHERE name LIKE '" . $value . "'";
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->value;
					}
				}

			$oneItem->abstract_review_outcome = !empty($textValue) ? implode(', ', $textValue) : $oneItem->abstract_review_outcome;

			}
		}
        return $items;
    }

}
