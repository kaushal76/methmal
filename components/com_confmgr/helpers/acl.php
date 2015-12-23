<?php

/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

/**
 * @desc		Abstract ACL helper class for the confmgt. Using a specific ACL for the component as the Joomla ACL does not serve the purpose
 * @package     Confmgr
 * @subpackage  Helpers
 */

abstract class AclHelper
{
	
	/**
	 * @desc		Method to check if the logged in user the author for a given paper id
	 * @param		int $paperid
	 * @return		boolean 
	 */
	
	public static function isAuthor($paperid = 0)
	{
		//Get the current user object
		$user = JFactory::getUser();
		
		if (!$paperid ==0)
		{
			
			//Obtain a database connection
			$db   = JFactory::getDbo();

			if ($user->id == 0) 
			{
				return FALSE;
			}
			
			//Build the query
			$query = $db->getQuery(true)	
			->select($db->quoteName('created_by'))
			->from($db->quoteName('#__confmgr_paper'))
			->where('id = ' . (int) $paperid);
				
			try
			{
				$db->setQuery($query);
				$result = $db->execute();
				// If it fails, it will throw a RuntimeException
			}
			catch (RuntimeException $e)
			{
				throw new Exception($e->getMessage());
			}
			
			if ($db->getNumRows() > 0) 
			{
				return TRUE;
			
			} 
			else 
			{
				return FALSE;
			}
		}
		else //No paper id given, hence only check if the user logged in. All logged in users can be authors
		{
			if ($user->guest)
			{
				return FALSE;
			}
			else 
			{
				return TRUE;
			}
			
		}
	}
	
	/**
	 * 
	 * @param number $themeid
	 * @param number $paperid
	 * @return boolean
	 * 
	 */

	public static function isThemeleader($themeid = 0, $paperid = 0)
	{

		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) 
		{
			return FALSE;
		} 
		
		if ($paperid == 0 && $themeid == 0) {
			
			if (self::isStudentCoordinator()) 
			{
				return TRUE;
			}
				
			if (self::isSuperCoordinator()) 
			{
				return TRUE;
			}
			
			//Building the query for the generic theme leader check. 
			$query = $db->getQuery(true)
			->select('user_id')
			->from($db->quoteName('#__confmgr_theme_leader'))
			->where('user_id = ' . (int) $user->id);
		}	
		else // either paperid and/or themeid provided
		{			
			//Build the query
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array(
					'a.theme_id',
					'a.id',
					'b.user_id',
					'b.id'
			)));
			$query->from($db->quoteName('#__confmgr_paper', 'a'));
			$query->join('INNER', $db->quoteName('#__confmgr_theme_leader', 'b') . ' ON (' . $db->quoteName('a.theme_id') . ' = ' . $db->quoteName('b.id') . ')');
			$query->where('b.user_id = ' . (int) $user->id);
			
			if ($paperid) 
			{
				if (self::isSuperCoordinator()) 
				{
					return TRUE;
				}
				elseif (self::isStudentPaper($paperid)) 
				{
					if (self::isStudentCoordinator()) 
					{
						return TRUE;
					}
				}
				else
				{
					$query->where('a.id = ' . (int) $paperid);
				}

			} 
			if ($themeid) 
			{
				if (self::isSuperCoordinator()) 
				{
					return TRUE;
				}
				else
				{
					$query->where('b.id = ' . (int) $themeid);
				}
			} 
		}	
		try
		{
			$db->setQuery($query);
			$result = $db->execute();
			// If it fails, it will throw a RuntimeException
		}
		catch (RuntimeException $e)
		{
			throw new Exception($e->getMessage());
		}
		
		if ($db->getNumRows() > 0)  
		{
			return TRUE;
		
		} 
		else 
		{
			return FALSE;
		}
	}

	/**
	 * @desc function to check if the logged in user is a Student Paper Coordinator
	 * @return boolean
	 * 
	 */
	
	public static function isStudentCoordinator()
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) 
		{
			return FALSE;
		}

		if (self::isSuperCoordinator()) 
		{
			return TRUE;
		}
		//Build the query
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array(
				'a.role',
				'a.user_id',
		)));
		$query->from($db->quoteName('#__confmgr_theme_leader', 'a'));
		$query->where('a.user_id = ' . (int) $user->id);
		$query->where('a.role ='.(int)1); // role(0) themeleader, role(1) studentcordinator role(2) supercordinator
		
		try
		{
			$db->setQuery($query);
			$result = $db->execute();
			// If it fails, it will throw a RuntimeException
		}
		catch (RuntimeException $e)
		{
			throw new Exception($e->getMessage());
		}
		
		if ($db->getNumRows() > 0) 
		{
			return TRUE;
		
		} 
		else 
		{
			return FALSE;
		}
	}

	/**
	 * @desc function to check if the logged in user is a Super Coordinator
	 * @return boolean
	 * @todo Update to meet the new database schema
	 */
	public static function isSuperCoordinator()
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) 
		{
			return FALSE; 
		}

		if(!$user->authorise('core.admin'))
		{
			return FALSE;
		}
		
		//Build the query
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array(
				'a.user_id',
				'a.role',
		)));
		$query->from($db->quoteName('#__confmgr_theme_leader', 'a'));
		$query->where('a.user_id = ' . (int) $user->id);
		$query->where('a.role ='.(int)2); // role(0) themeleader, role(1) studentcordinator role(2) supercordinator
		
		try
		{
			$db->setQuery($query);
			$result = $db->execute();
			// If it fails, it will throw a RuntimeException
		}
		catch (RuntimeException $e)
		{
			throw new Exception($e->getMessage());
		}
		
		if ($db->getNumRows() > 0) 
		{
			return TRUE;
		
		} 
		else 
		{
			return FALSE;
		}
	}
	
	/**
	 * @desc Method to check if a paper is a student submission
	 * @param int $paperid
	 * @return boolean
	 * 
	 */

	public static function isStudentPaper($paperid)
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		if ($user->id == 0) 
		{
			return FALSE;
		} 

		$query = $db->getQuery(true)->select($db->quoteName(array(
				'a.id',
				'a.student_paper'
		)))->from($db->quoteName('#__confmgr_paper', 'a'));
		$query->where('a.student_paper = ' . (int) 1);

		try
		{
			$db->setQuery($query);
			$result = $db->execute();
			// If it fails, it will throw a RuntimeException
		}
		catch (RuntimeException $e)
		{
			throw new Exception($e->getMessage());
		}
		
		if ($db->getNumRows() > 0) 
		{
			return TRUE;
		
		} 
		else 
		{
			return FALSE;
		}
	}
	
	/**
	 * @desc method to check if the logged in user is a reviewer for a given paper
	 * @param number $paperid
	 * @return boolean
	 * @todo Update to meet the new database schema
	 */

	public static function isRev1ewer($paperid = 0)
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		
		if ($user->id == 0) 
		{
			return FALSE;
		} 
		
		if ($paperid == 0) 
		{
			//Build the query
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array(
			'a.id',
			'a.user_id',
			'a.agreed'
			)))->from($db->quoteName('#__confmgr_rev1ewer', 'a'))
			->where('a.user_id = ' . (int) $user->id)
			->where('a.agreed = 1');
		} 
		else 
		{
			//Build the query
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array(
			'a.rev1ewer_id',
			'a.paper_id',
			'b.agreed',
			'b.user_id',
			'c.id'
			)))->from($db->quoteName('#__confmgr_rev1ewer_for_paper', 'a'))
			->join('INNER', $db->quoteName('#__confmgr_rev1ewer', 'b') . ' ON (' . $db->quoteName('a.rev1ewer_id') . ' = ' . $db->quoteName('b.id') . ')')
			->join('INNER', $db->quoteName('#__users', 'c') . ' ON (' . $db->quoteName('b.user_id') . ' = ' . $db->quoteName('c.id') . ')')
			->where('c.id = ' . (int) $user->id)
			->where('a.paper_id = ' . (int) $paperid)
			->where('b.agreed = 1');
		}
		// get the number of records
		
		try
		{
			$db->setQuery($query);
			$result = $db->execute();
			// If it fails, it will throw a RuntimeException
		}
		catch (RuntimeException $e)
		{
			throw new Exception($e->getMessage());
		}
		
		if ($db->getNumRows() > 0) 
		{
			return TRUE;
		
		} 
		else 
		{
			return FALSE;
		}
	}
	
	/**
	 * @desc method to get the theme for a given paper
	 * @param number $paperid
	 * @return mixed|boolean
	 * @todo Update to meet the new database schema
	 */

	public static function getTheme($paperid = 0)
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();

		//Build the query
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array(
				'a.theme',
				'a.id',
				'b.userid',
				'b.id',
				'b.title'
		)));
		$query->from($db->quoteName('#__confmgt_papers', 'a'));
		$query->join('INNER', $db->quoteName('#__confmgt_themes', 'b') . ' ON (' . $db->quoteName('a.theme') . ' = ' . $db->quoteName('b.id') . ')');
		
		//- paper id given, hence checking if the themeleader for the given paper
		if ($paperid) {
			$query->where('a.id = ' . (int) $paperid);
		} //$paperid

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
	/**
	 * @desc method to get userid by entering the email
	 * @param unknown $email
	 * @return boolean
	 * @todo Update to meet the new database schema
	 */
	
	public static function getUserID($email)
	{
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		$query = $db->getQuery(true)->select('id, email')->from($db->quoteName('#__users'))->where($db->quoteName('email') . ' = ' . $db->quote($email));
		//Prepare the query
		$db->setQuery($query);
		// Load the row.
		$row = $db->loadObject();
		if ($row) {
			return $row->id;
		} //$row
		else {
			return false;
		}
	}
	
	/**
	 * @desc method to get Reviewer ID by email
	 * @param unknown $email
	 * @return mixed|boolean
	 * @todo Update to meet the new database schema
	 */
	public static function getRev1ewerID($email)
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		//Build the query
		$query = $db->getQuery(true)->select($db->quoteName(array(
				'a.id',
				'a.userid',
				'a.email',
				'a.agreed'
		)))->from($db->quoteName('#__confmgt_rev1ewers', 'a'))->where($db->quoteName('email') . ' = ' . $db->quote($email));
		//Prepare the query
		$db->setQuery($query);
		$row = $db->loadObject();
		if ($row) {
			return $row;
		} //$row
		else {
			return false;
		}
	}
	
	/**
	 * @desc method to get the number of reviewers for a given paper
	 * @param unknown $paperid
	 * @return boolean|number
	 * @todo Update to meet the new database schema
	 */
	
	public static function getNumofRev1ewers($paperid)
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();
		if ($user->id == 0) {
			return false;
		} //$user->id == 0
		//Build the query
		$query = $db->getQuery(true)->select($db->quoteName(array(
				'a.id',
				'a.userid',
				'a.email',
				'a.agreed'
		)))->from($db->quoteName('#__confmgt_rev1ewers_papers', 'a'))->where($db->quoteName('paperid') . ' = ' . (int) ($paperid));
		//Prepare the query
		$db->setQuery($query);
		$db->execute();
		$num_rows = $db->getNumRows();
		if ($num_rows > 0) {
			return $num_rows;
		} //$num_rows > 0
		else {
			return false;
		}
	}
	/**
	 * @desc method to get authors for a given paper
	 * @param number $paperid
	 * @return mixed|boolean
	 */
	
	public static function getAuthors($paperid = 0)
	{
		//Obtain a database connection
		$db   = JFactory::getDbo();
		$user = JFactory::getUser();

		//- paper id given, hence checking if the themeleader for the given paper
		//Build the query
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array(
				'a.title',
				'a.firstname',
				'a.surname',
				'a.email',
				'a.linkid',
				'a.institution',
				'a.country',
				'a.ordering'
		)));
		$query->from($db->quoteName('#__confmgt_authors', 'a'));
		if ($paperid) {
			$query->where('a.linkid = ' . (int) $paperid);
			$query->order('a.ordering ASC');
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
}
