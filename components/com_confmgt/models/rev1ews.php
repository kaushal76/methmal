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
class ConfmgtModelRev1ews extends JModelList {

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
        $query->select( array('a.paperid AS paperid', 'a.reviewerid AS rev1ewerid', 'b.userid AS userid', 'b.last_updated AS revassigned', 'c.title as title', 'c.abstract_review_outcome as abreviewoutcome', 'c.full_review_outcome as fullreviewoutcome', 'c.abstract as abtract', 'c.full_paper as fullpaper', 'COUNT(d.id) AS reviewsposted'));
        $query->from('#__confmgt_rev1ewers_papers AS a');
		$query->join('LEFT', $db->quoteName('#__confmgt_rev1ewers', 'b') . ' ON (' . $db->quoteName('a.reviewerid') . ' = ' . $db->quoteName('b.id') . ')');
		$query->join('LEFT', $db->quoteName('#__confmgt_papers', 'c') . ' ON (' . $db->quoteName('a.paperid') . ' = ' . $db->quoteName('c.id') . ')');
		$query->join('LEFT', $db->quoteName('#__confmgt_reviews', 'd') . ' ON (' . $db->quoteName('d.created_by') . ' = ' . $db->quoteName('b.userid') . 'AND ' . $db->quoteName('d.linkid') . ' = ' . $db->quoteName('a.paperid') . ')');
		
		$query->where('b.userid ='.(int)$user->id);
		$query->where('c.id > '.(int)0);
		$query->group ('a.paperid');
		$query->group ('a.reviewerid');
		$query->order('c.id ASC');  
		return $query;
		
	}
 
	public function getItems() {
        return parent::getItems();
    }
	
	public function getItemsPending() {
		 
		$all_items = $this->getItems();
		$return = array();
		$i=0;
		foreach ($all_items as $item) {
			if (($item->reviewsposted ==0) && ($item->abreviewoutcome ==0)) { 
				$return[$i]->paperid = $item->paperid; 
				$return[$i]->title = $item->title;
				$return[$i]->due_date = $item->revassigned;  
				$return[$i]->mode = 'Abstract';
				$return[$i]->fullpaper = $item->fullpaper;
			}elseif (($item->abreviewoutcome >0)&&($item->fullpaper) && ($item->fullreviewoutcome ==0)&&($item->reviewsposted <2)){
				$return[$i]->paperid = $item->paperid;
				$return[$i]->title = $item->title;
				$return[$i]->due_date = $item->revassigned; 
				$return[$i]->mode = 'Full';
				$return[$i]->fullpaper = $item->fullpaper;		
			}
			$i = $i+1;
		}
		if (!empty( $return)) {
			return $return;
		}else{
			return false;
		}						 
	}
	
	public function getItemsCompleted($paperid=0, $mode=0) {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user = JFactory::getUser();
		
  	    // Select the required fields from the table. 
        $query->select( 'a.id as rev_id')
			  ->select( 'a.recommendation as recommendation')
			  ->select( 'a.author_comments as author_comments')
			  ->select( 'a.leader_comments as leader_comments')
			  ->select( 'a.score as score')
			  ->select( 'a.last_updated as last_updated')
			  ->select( 'a.mode as mode')
			  ->select( 'a.linkid as rev_linkid')
			  ->select( 'a.created_by as created_by')
			  ->select( 'b.*'); 		
        $query->from('#__confmgt_reviews AS a');
		$query->join('INNER', $db->quoteName('#__confmgt_papers', 'b') . ' ON (' . $db->quoteName('a.linkid') . ' = ' . $db->quoteName('b.id') . ')');
		$query->where('a.created_by ='.(int)$user->id);
		
		if ($paperid > 0) {
			$query->where('a.paperid = '.(int)$paperid);
		} 
		
		if ($mode) {
			$query->where('a.mode = '.(string)$mode);
		}
		
		$query->order('a.linkid ASC'); 
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if (!empty($results)) {
			return $results;
		}else{
			return false; 
		}							 
	}
}
