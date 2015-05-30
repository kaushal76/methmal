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
class ConfmgtModelRev1ewers extends JModelList {

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

        

        // List state information.
        //parent::populateState($ordering, $direction);
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
	
	
	
	public function getTable($type = 'Rev1ewers', $prefix = 'ConfmgtTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
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
		
	    // Select the required fields from the table.
        $query->select( array('a.*', 'COUNT(b.reviewerid) AS papers'));
        $query->from('#__confmgt_rev1ewers AS a');
		$query->join('LEFT', $db->quoteName('#__confmgt_rev1ewers_papers', 'b') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('b.reviewerid') . ')');
		$query->group('a.id');
		$query->order('a.ordering ASC'); 
		return $query;
		
	}

	public function getItems() {
        return parent::getItems();
    }

}
