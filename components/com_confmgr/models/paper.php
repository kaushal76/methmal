<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Item Model for paper.
 *
 * @package     Confmgr
 * @subpackage  Models
 */
class ConfmgrModelPaper extends JModelAdmin
{
	/**
	 * @var        string    The prefix to use with controller messages.
	 * @since   1.6
	 */
	protected $text_prefix = 'COM_CONFMGR';

	/**
	 * The type alias for this content type.
	 *
	 * @var      string
	 * @since    3.2
	 */
	public $typeAlias = 'com_confmgr.paper';

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object    $record    A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 * @since   1.6
	 */
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->published != -2)
			{
				return false;
			}
			$user = JFactory::getUser();
			return AclHelper::isAuthor($record->id);
		}
	}		

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param   JTable    A JTable object.
	 *
	 * @return  void
	 * @since   1.6
	 */
	protected function prepareTable($table)
	{
		// Set the publish date to now
		$db = $this->getDbo();

		// Increment the content version number.
		$table->version++;
	}

	/**
	 * Auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('administrator');

		// Load the User state.
		$pk = $app->input->getInt('id');
		$this->setState($this->getName() . '.id', $pk);
		
		// Load the parameters.
		$params = JComponentHelper::getParams('com_confmgr');
		$this->setState('params', $params);
	}
	
	/**
	 * Alias for JTable::getInstance()
	 *
	 * @param   string  $type    The type (name) of the JTable class to get an instance of.
	 * @param   string  $prefix  An optional prefix for the table class name.
	 * @param   array   $config  An optional array of configuration values for the JTable object.
	 *
	 * @return  mixed    A JTable object if found or boolean false if one could not be found.
	 */
	public function getTable($type = 'Paper', $prefix = 'ConfmgrTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Method for getting the form from the model.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 */
	public function getForm($data = array(), $loadData = true)
	{
		JForm::addFormPath(JPATH_COMPONENT_ADMINISTRATOR.'/models/forms');
		JForm::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR.'/models/fields');
		JForm::addRulePath(JPATH_COMPONENT_ADMINISTRATOR.'/models/rules');		
		
		$options = array('control' => 'jform', 'load_data' => $loadData);
		$form = $this->loadForm($this->typeAlias, $this->name, $options);
		
		if(empty($form))
		{
			return false;
		}

		return $form;
	}
	
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  array    The default data is an empty array.
	 */
	protected function loadFormData()
	{
		$app = JFactory::getApplication();
		$data = $app->getUserState($this->option . '.edit.' . $this->name . '.data', array());
		
		if(empty($data))
		{
			$data = $this->getItem();
		}
		
		return $data;
	}
	
	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
		if (!$item = parent::getItem($pk))
		{			
			throw new Exception(JText::_('COM_CONFMGR_FAILED_TO_LOAD_ITEM'));
		}

		if (!$item->id)
		{
		}
		else 
		{
			$data = $this->_getData($item->id);
			$item->abstract = $data->abstract;
			$item->theme = $data->theme;
			$item->keywords = $data->keywords;
		}
		
		return $item;
	}
	
	/**
	 * @desc	Method to get the paper details and abstract details using a joint query
	 * @return	mixed object on success, false on faliure
	 * @param	(int) primary key ($pk)
	 */
	
	private function _getData($pk = NULL)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
	
		// Construct the query
		$query->select('a.paper_id AS paper_id, a.abstract AS abstract, a.keywords AS keywords, a.theme AS theme')
		->from('#__confmgr_abstract AS a')
		->select('p.id AS id, p.title AS title, p.student_paper AS student_paper, p.created_by AS created_by ')
			->join('INNER', '#__confmgr_paper AS p ON p.abstract_id = a.id')
		->where('p.id = '.(int)$pk);

	
		// Setup the query
		$db->setQuery($query);
	
		// Return the result
		return $db->loadObject();
	}
	
	/**
	 * Increment the hit counter for the item.
	 *
	 * @param   integer  $pk  Optional primary key of the item to increment.
	 *
	 * @return  boolean  True if successful; false otherwise and internal error set.
	 */
	public function hit($pk = 0)
	{
		$input = JFactory::getApplication()->input;
		$hitcount = $input->getInt('hitcount', 1);

		if ($hitcount)
		{
			$pk = (!empty($pk)) ? $pk : (int) $this->getState('paper.id');

			$table = $this->getTable();
			$table->load($pk);
			$table->hit($pk);
		}

		return true;
	}
	
	/**
	 * Method to create a new abstract on template
	 * @param array() $data
	 * @TODO update the method to depriciate JERROR
	 */
	public function newAbstract($data)	
	{
		$user = JFactory::getUser();
		$data = array();
	
		//insert the author ID
		$data['created_by'] = $user->id;
	
		//get the table
		$table = $this->getTable();
	
		//save an empty record to reserve the paper id
		try  
		{
			$table->save($data);
				
			//get the last created paper id
			$id = $table->id;
			//check the author and return the last paper id

			if ($table->created_by == $user->id)
			{
				//make the abstract active
				$data_new['published'] = (int)1;
				$data_new['id'] = $id;
				
				//save the row once more
				if ($table->save($data_new) === true) 
				{
					// return the new ID
					$id_new = $table->id;
					return $id_new;
				}
				else
				{
					return false;
				}
	
			}
			else
			{
				throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'),403);
				return false;
			}
				
		}
		catch (exception $e)
		{
			throw new exception ($e->getMessage().' '.$table->getError());
			return false;
		}
	}
	
	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The id on success, false on failure.
	 * @since	1.6
	 */
	public function save($data)
	{
		$id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('paper.id');
		$state = (!empty($data['state'])) ? 1 : 0;
		$user = JFactory::getUser();
		$app = JFactory::getApplication();
	
		//preparing abstract data intially
		$data_abstract = $data;
		$data_abstract['paper_id'] = $id;
		$data_abstract['id'] = $data['abstract_id'];

		if($id) 
		{
			//Check the user can edit this item
			$authorised = AclHelper::isAuthor($id);
		} 
		else 
		{
			//Check the user can create new items in this section
			$authorised = ($user->id > 0);
		}
			
		if (!$authorised) 
		{
			throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
			return false;
		}
	
		$table = $this->getTable();
		$abstract_table = $this->getTable('Abstract', 'ConfmgrTable');
		
	
		//save abstract data first
		$abstract_data = $abstract_table->save($data_abstract);
	
		if ($abstract_data) 
		{
			//set the abstractid data for the papers table
			$data['abstract_id'] = $abstract_table->id;

			// Then save the paper data
			if (!$table->save($data)) 
			{
				//something wrong saving to the abstract table
				$app->enqueueMessage($table->getError(),'error');
				return false;
			}
			// all fine, return true
			return true;
		}
		else
		{		
			//something wrong with saving to the papers table.
			$app->enqueueMessage($abstract_table->getError(),'error');
			return false;
		}
	
	}
}
