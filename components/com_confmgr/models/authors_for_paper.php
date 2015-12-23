<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

/**
 * List Model for authors_for_paper.
 *
 * @package     Confmgr
 * @subpackage  Models
 */
class ConfmgrModelAuthors_for_paper extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = 'paper_id', $direction = 'ASC')
	{
		parent::populateState($ordering, $direction);
	}
	
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{

		return parent::getStoreId($id);
	}
	
	/**
	 * Method to get Authors assigned for a particular paper
	 * @param	int	$paper_id
	 * @return	mixed  An Indexed array of PHP objects on success, false on failure. 
	 */
	
	public function getAuthorsForPaper($paper_id)
	{

		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('a.*')->from('#__confmgr_author_for_paper AS a');
		
		$query->select($query->concatenate(array('uc.title','uc.firstname','uc surname'),' '))
		->join('LEFT', '#__confmgr_authors AS uc ON uc.id = a.author_id');
		$query->where('a.paper_id = '.(int)($paper_id));
		$db->setQuery($query);
		try 
		{
			$row = $db->loadObjectList();
		}
		catch (exception $e)
		{
			throw new exception ($e->getMessage().' COM_CONFMGR_MODEL_AUTHORS_FOR_PAPER_DB_ERROR');
			
		}
		
		return $row;
		
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 */
	protected function getListQuery()
	{
		// Get database object
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('a.*')->from('#__confmgr_author_for_paper AS a');						

		$query->select($query->concatenate(array('uc.title','uc.firstname','uc surname'),' '))
			->join('LEFT', '#__authors AS uc ON uc.id = a.author_id');
		$query->where('a.paper_id = '.(int)($paper_id));
		return $query;
	}
	
	/**
	 * Method to get an array of data items.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 *
	 * @since   12.2
	 */
	public function getItems()
	{
		if ($items = parent::getItems()) {
			//Do any procesing on fields here if needed
		}

		return $items;
	}
	
}
?>