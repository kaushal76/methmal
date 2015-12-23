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
class ConfmgtModelAuthors extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
		$app = JFactory::getApplication();


        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

        

        // List state information.
        parent::populateState($ordering, $direction);
    }
	
	/**
     * BMethod to get the LinkID set in either the user session data or the fget / post data.
     *
     * @return	linkid
     * 
     */
	public function &getLinkid()
	{
		$linkid = JFactory::getApplication()->getUserStateFromRequest( "com_confmgt.linkid", 'linkid', 0 );
		if ($linkid == 0)
		{
			JError::raiseError('500', JText::_('JERROR_NO_PAPERID'));
			return false;
		}else{		
			return $linkid;
		}		
	}
	
	/**
	 * Method to adjust the ordering of a row.
	 *
	 * Returns NULL if the user did not have edit
	 * privileges for any of the selected primary keys.
	 *
	 * @param   integer  $pks    The ID of the primary key to move.
	 * @param   integer  $delta  Increment, usually +1 or -1
	 *
	 * @return  mixed  False on failure or error, true on success, null if the $pk is empty (no items selected).
	 *
	 * @since   11.1
	 */
	public function reorder($pks, $delta = 0)
	{
		// Initialise variables.
		$table = $this->getTable();
		$pks = (array) $pks;
		$result = true;

		$allowed = true;

		foreach ($pks as $i => $pk)
		{
			$table->reset();

			if ($table->load($pk) && $this->checkout($pk))
			{
	
				$where = array();
				$where = $this->getReorderConditions($table);

				if (!$table->move($delta, $where))
				{
					$this->setError($table->getError());
					unset($pks[$i]);
					$result = false;
				}

				$this->checkin($pk);
			}
			else
			{
				$this->setError($table->getError());
				unset($pks[$i]);
				$result = false;
			}
		}

		if ($allowed === false && empty($pks))
		{
			$result = null;
		}

		// Clear the component's cache
		if ($result == true)
		{
			$this->cleanCache();
		}
		return $result;
	}
	
		
	
	/**
	 * Saves the manually set order of records.
	 *
	 * @param   array    $pks    An array of primary key ids.
	 * @param   integer  $order  +1 or -1
	 *
	 * @return  mixed
	 *
	 * @since   11.1
	 */
	public function saveorder($pks = null, $order = null)
	{
		// Initialise variables.
		$table = $this->getTable();
		$conditions = array();

		if (empty($pks))
		{
			return JError::raiseWarning(500, JText::_($this->text_prefix . '_ERROR_NO_ITEMS_SELECTED'));
		}

		// Update ordering values
		foreach ($pks as $i => $pk)
		{
			$table->load((int) $pk);

			if ($table->ordering != $order[$i])
			{
				$table->ordering = $order[$i];

				if (!$table->store())
				{
					$this->setError($table->getError());
					return false;
				}

				// Remember to reorder within position and client_id
				$condition = $this->getReorderConditions($table);
				$found = false;

				foreach ($conditions as $cond)
				{
					if ($cond[1] == $condition)
					{
						$found = true;
						break;
					}
				}

				if (!$found)
				{
					$key = $table->getKeyName();
					$conditions[] = array($table->$key, $condition);
				}
			}
		}

		// Execute reorder for each category.
		foreach ($conditions as $cond)
		{
			$table->load($cond[0]);
			$table->reorder($cond[1]);
		}

		// Clear the component's cache
		$this->cleanCache();

		return true;
	}
	
	
	
	public function getTable($type = 'Author', $prefix = 'ConfmgtTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
	} 
	
	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param   JTable  $table  A JTable object.
	 *
	 * @return  array  An array of conditions to add to ordering queries.
	 *
	 * @since   11.1
	 */
	protected function getReorderConditions($table)
	{
		return array();
	}

        

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user = JFactory::getUser();
		
		// get the paper id		
		$linkid = $this->getLinkid();	
		 // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );

        $query->from('`#__confmgt_authors` AS a');
		$query->where('created_by ='.$user->id);
		if (!$linkid==0) { 
			$query->where('linkid ='.$linkid);
		}else{
			JError::raiseError(500, 'No paper id');
			return false;
		}
		$query->order('a.ordering ASC');
        
        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                
            }
        }
		
		return $query;
		
	}

	public function getItems() {
		
		// This is the best place to compact the ordering..
		$linkid = $this->getLinkid();
		$table = $this->getTable();
		// Reset the author ordering values 
		$table->reorder('linkid='.$linkid);	
		
		// Return the parent getItem method 
        return parent::getItems();
    }

}
