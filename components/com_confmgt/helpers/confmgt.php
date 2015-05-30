<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
defined('_JEXEC') or die;

abstract class ConfmgtHelper
{
	    /**
     * Method to get the paper ID .
     *
     * @param	none
     *
     * @return	paper ID (Int) on success false on failure.
     */
    public static function getLinkid( )
    {
        $linkid = JFactory::getApplication()->getUserStateFromRequest( "com_confmgt.linkid", 'linkid', 0 );
        if ( $linkid == 0 ) {
            JError::raiseError( '500', JText::_( 'JERROR_NO_PAPERID' ) );
            return false;
        } //$linkid == 0
        else {
            return $linkid;
        }
    }
	
	public static function getRev1ews($paperid = 0, $mode=0)
    {
        //Obtain a database connection
        $db   = JFactory::getDbo();
 
		//- paper id given, hence checking if the themeleader for the given paper
		//Build the query 
		$query = $db->getQuery(true);
		$query->select('a.*');
		$query->from($db->quoteName('#__confmgt_reviews', 'a'));
		if ($paperid) {
			$query->where('a.linkid = ' . (int) $paperid); 
			if ($mode) {
				$query->where('a.mode = '."'".$mode."'");
			}// $mode
			$query->order('a.id ASC');
		} //$paperid

        // get the number of records
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($rows) {
            return $rows;
        } //$row
        else {
            return false;
        }
    }
	
	public static function getPaper($paperid = 0)
    {
        //Obtain a database connection
        $db   = JFactory::getDbo();
 
		//- paper id given, hence checking if the themeleader for the given paper
		//Build the query 
		$query = $db->getQuery(true);
		$query	->select('a.*')
				->select($db->quoteName('b.userid', 'leaderid'))
				->select($db->quoteName('b.id', 'themeid'))
				->select($db->quoteName('b.title', 'themename'));
		$query->from($db->quoteName('#__confmgt_papers', 'a'));
		$query->join('INNER', $db->quoteName('#__confmgt_themes', 'b') . ' ON (' . $db->quoteName('a.theme') . ' = ' . $db->quoteName('b.id') . ')');
		$query->where('a.id = ' . (int) $paperid);

        // get the number of records
        $db->setQuery($query);
        $row = $db->loadObject();
        if ($row) {
            return $row;
        } //$row
        else {
            return false;
        }
    }
	
	public static function getAuthors($paperid = 0) {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$user = JFactory::getUser();
		 
			
		 // Select the required fields from the table.
        $query->select('a.*');
        $query->from('`#__confmgt_authors` AS a');
		
		if (!$paperid==0) { 
			$query->where('linkid ='.$paperid);
		}else{
			JError::raiseError(500, 'No paper id');
			return false;
		}
		$query->order('a.ordering ASC');
		$db->setQuery($query); 
		
		// Load the row.
		$rows = $db->loadObjectlist();	
		return $rows;
		
	}
	
	public static function getRev1ewers($paperid =0) {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$user = JFactory::getUser();
		
		 // Select the required fields from the table.
        $query->select('a.*');
        $query->from('`#__confmgt_rev1ewers_papers` AS a');
		$query->select(array('b.id AS revid','b.surname AS revsurname', 'b.title as revtitle', 'b.firstname as revfirstname'));
		$query->join('LEFT', '#__confmgt_rev1ewers AS b ON b.id=a.reviewerid');
		if (!$paperid==0) { 
			$query->where('a.paperid ='.$paperid);
		}else{
			JError::raiseError(500, 'No paper id');
			return false;
		}
		$query->order('a.reviewerid ASC');

		//Prepare the query
		$db->setQuery($query); 
		
		// Load the row.
		$rows = $db->loadObjectlist();	
		return $rows; 
		
	}
	
	public static function getUsers() {
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__users" ;
		$db->setQuery($query);
		
		$rows = $db->loadObjectList();
		return $rows;
	}
	
	public static function getRev1ewer($revid = 0) {
		if ($revid == 0) {
			return false;
		}
		
		$db =& JFactory::getDBO();
		$query = $db->getQuery(true);
		$query	
			->select('a.*')
			->select('COUNT(b.reviewerid) AS papers');
		$query->from($db->quoteName('#__confmgt_rev1ewers', 'a'));
		$query->join('LEFT', $db->quoteName('#__confmgt_rev1ewers_papers', 'b') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('b.reviewerid') . ')');
		$query->where('a.id = '.$revid);
		$query->group('a.id');
		$query->order('a.ordering ASC'); 
		$db->setQuery($query);
		$row = $db->loadObject();
		if ($row) {
            return $row;
        } //$row
        else {
            return false;
        }
	}
}


