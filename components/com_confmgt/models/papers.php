<?php

/**
 * @version     2.5.8.1
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
     * @see      JController
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
		
		//Reset the link ID
		$linkid = JFactory::getApplication()->setUserState('com_confmgt.linkid', null);

        // List state information.
        parent::populateState($ordering, $direction);
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
		
		//Get the current user
		
		$user = JFactory::getuser();

        // Select the required fields from the table.
        $query->select('a.*');
        $query->from('`#__confmgt_papers` AS a');
		
		// Only the papers submitted by the user
		$query->where('a.created_by ='. $user->id);
		
		// Only the papers which are not archieved
		$query->where('a.state =1');
        
		//join the themes table
		$query->select('b.title AS themename');
   		$query->join('LEFT', '#__confmgt_themes AS b ON b.id=a.theme');
   
		$query->order('a.id ASC');
        
        return $query;
    }
	
	
	
	protected function tmpRemoveQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);
		$user = JFactory::getUser();

        // Select the required fields from the table.
        $query->delete($db->quoteName('#__confmgt_papers'));
	    $query->where("title = ''");
		$query->where('created_by = '.$user->id);
 
        $db->setQuery($query);
		$result = $db->query();
    }

    public function getItems() {
    			
		//remove temporary papers
		$this->tmpRemoveQuery();	
		
        return parent::getItems();
    }
	
	 /**
     * Method to get the paper list for theme leaders 
     *
     * @return	List
     * 
     */
	
	public function getLeadersItems() {
		
		//remove temporary papers
		$this->tmpRemoveQuery();
		
		// Get a db connection.
		$db = JFactory::getDbo();
		 
		// Create a new query object.
		$query = $db->getQuery(true);
		$user = JFactory::getUser();
		
		// @todo - format the query with escape characters 
		$query
			->select('a.*')
			->from('#__confmgt_papers as a')
			->select('b.title as theme')
			->join('LEFT', '#__confmgt_themes as b ON a.theme = b.id')
			->select('uc.name as author')
			->select('COUNT(d.reviewerid) AS rev1ewers')
			->join('LEFT', '#__users as uc ON uc.id = a.created_by')
			->join('LEFT', $db->quoteName('#__confmgt_rev1ewers_papers', 'd') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('d.paperid') . ')');
			if (AclHelper::isSuperCoordinator()) { // Super coordinator, hence all papers are selected
			}elseif (!AclHelper::isStudentCoordinator()) { //Not super coordinator and not a student coordinator, hence only papers within the relevant themes
				$query->where('b.userid = '.$user->id);
				$query->where('a.student_submission = 0');
			}else{ // Student coordinator hence student papers and papers within the relevant themes
				$query->where('a.student_submission = 1 OR b.userid = '.$user->id);
			}
			// Only the papers which are not archieved
			$query->where('a.state =1');
			$query->group('a.id');
			$query->order('a.id ASC');
		 
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		 
		// Load the results as a list of stdClass objects (see later for more options on retrieving data).
		$results = $db->loadObjectList();

	return $results;
	}
	
}
