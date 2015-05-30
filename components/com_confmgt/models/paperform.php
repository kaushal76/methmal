<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Confmgt model.
 */
class ConfmgtModelPaperForm extends JModelForm
{
    
    var $_item = null;
    
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('com_confmgt');

		// Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_confmgt.edit.paper.id');
			$this->setState('paper.id', $id);
		} else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_confmgt.edit.paper.id', $id);
			$linkid = JFactory::getApplication()->setUserState('com_confmgt.linkid', $id);
			$this->setState('paper.id', $id);
        }
		
		// Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
            $this->setState('paper.id', $params_array['item_id']);
        }
		$this->setState('params', $params);

	}
	
	/**
	 * Method to get the paper ID .
	 *
	 * @param	none
	 *
	 * @return	paper ID (Int) on success false on failure.
	 */
	public function getLinkid()
	{
		$linkid = ConfmgtHelper::getLinkId();
		return $linkid;
	}
        

	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id)) {
				$id = $this->getState('paper.id');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
                
                // Can the user edit the paper
				$user = JFactory::getUser();
                $id = $table->id;
				
				if ($id) {					
				$canEdit = AclHelper::isAuthor($id);				
				}else{				
				$canEdit = ($user->id > 0);				
				}				
	
				if (!$canEdit) {
					JError::raiseError('500', JText::_('JERROR_ALERTNOAUTHOR'));
                }
                
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if ($table->state != $published) {
						return $this->_item;
					}
				}

				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');
				
			} elseif ($error = $table->getError()) {
				
				$this->setError($error);
			}
		}

		return $this->_item;
	}
    
	public function getTable($type = 'Paper', $prefix = 'ConfmgtTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
	}     

    
	/**
	 * Method to check in an item.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkin($id = null)
	{
		// Get the id.
		$id = (!empty($id)) ? $id : (int)$this->getState('paper.id');

		if ($id) {
            
			// Initialise the table
			$table = $this->getTable();

			// Attempt to check the row in.
            if (method_exists($table, 'checkin')) {
                if (!$table->checkin($id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}

		return true;
	}

	/**
	 * Method to check out an item for editing.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkout($id = null)
	{
		// Get the user id.
		$id = (!empty($id)) ? $id : (int)$this->getState('paper.id');

		if ($id) {
            
			// Initialise the table
			$table = $this->getTable();

			// Get the current user object.
			$user = JFactory::getUser();

			// Attempt to check the row out.
            if (method_exists($table, 'checkout')) {
                if (!$table->checkout($user->get('id'), $id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}

		return true;
	}    
    
	/**
	 * Method to get the profile form.
	 *
	 * The base form is loaded from XML 
     * 
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_confmgt.paper', 'paperform', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_confmgt.edit.paper.data', array());
        if (empty($data)) {
            $data = $this->getData();
        }
        
        return $data;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function save($data)
	{
		$id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('paper.id');
        $state = (!empty($data['state'])) ? 1 : 0;
        $user = JFactory::getUser();
		
		//preparing abstract data intially
		$data_prepared = $data;
		$data_prepared['id'] = $data['abstractid'];
		$data_prepared['linkid'] = $id;
		
	
		if($id) {
            //Check the user can edit this item
            $authorised = AclHelper::isAuthor($id);
        } else {
            //Check the user can create new items in this section 
            $authorised = ($user->id > 0);
        }
			
        if ($authorised !== true) {
           JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
           return false;
        }
        
        $table = $this->getTable();
		$abstract_table = $this->getTable('Abstract', 'ConfmgtTable');
		
		//save abstract data first
		$abstract_data = $abstract_table->save($data_prepared);
		
		if ($abstract_data) {
			
			//set the abstractid data for the papers table 
			$data['abstractid'] = $abstract_table->id;
			
			if (!$table->save($data) === true) {
				//something wrong saving to the abstract table
				$this->setError($table->getError());
				return false;
			}
				// all fine, return true
				return true;
		}else{
			
			//something wrong with saving to the papers table.
			$this->setError($table->getError());
			return false;
		}

	}
	
		/**
	 * Method to save the resubmitted abstract form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function save_resubmit($data)
	{
        $user = JFactory::getUser();
		
		//preparing abstract data intially
		$data_prepared = $data;
		$data_prepared['id'] = 0;
		
	
		//Check the user can edit this item
		$authorised = AclHelper::isAuthor($data['linkid']);
			
        if ($authorised !== true) {
           JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
           return false;
        }
        
        $table = $this->getTable();
		$abstract_table = $this->getTable('Abstract', 'ConfmgtTable');
		
		//save abstract data first
		$abstract_data = $abstract_table->save($data_prepared);
		
		if ($abstract_data) {
			
			//set the abstractid data for the papers table 
			$data['abstractid'] = $abstract_table->id;
			$data['id'] = $linkid;
			
			if (!$table->save($data) === true) {
				//something wrong saving to the abstract table
				$this->setError($table->getError());
				return false;
			}
				// all fine, return true
				return true;
		}else{
			
			//something wrong with saving to the papers table.
			$this->setError($table->getError());
			return false;
		}

	}
	
	/**
	 * Method to save the inline editing data through ajax.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The id on success, false on failure.
	 * @since	2.5.5
	 */
	public function save_ajax($data)
	{
		$id = $data['id'];
        $user = JFactory::getUser();
		
	
		if($id) {
            //Check the user can edit this item
            $authorised = AclHelper::isAuthor($id);
        } else {
            
            $authorised = false;
        }
			
        if ($authorised !== true) {
           JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
           return false;
        }
        $table = $this->getTable();		
		//save data
		$return = $table->save($data);	
		if ($return) {
				// all fine, return true
				return true;
		}else{
			//something wrong with saving to the papers table.
			$this->setError($table->getError());
			return false;
		}

	}
	
		/**
	 * Method to create a new abstract - reserve and return the paper ID.
	 *
	 * @param	boolian		
	 * @return	mixed		The newly created paper id on success, false on failure.
	 * 
	 */
	
	
	public function newAbstract($data)	{
		$user = JFactory::getUser();
		$data = array();
		
		//insert the author ID
		$data['created_by'] = $user->id;
		
		//get the table
		$table = $this->getTable();
		
		//save an empty record to reserve the paper id
        if ($table->save($data) === true) {
			
		//get the last created paper id	
    	$id = $table->id; 
		//check the author and return the last paper id
			if ($table->created_by == $user->id) {
				//update the linkid field with the new ID created
				$data_new['linkid'] = $table->id;
				//make the abstract active
				$data_new['active'] = 1;
				//save the row once more
				if ($table->save($data_new) === true) {
					// return the new ID
					$id_new = $table->id;
					return $id_new;
				}else{
            		return false;
				}
				
			}else{
				JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
            	return false;
			}
							
        } else {
			$this->setError($table->getError());
            return false;
        } 
		
	}
    
     function delete($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('paper.id');
        if(AclHelper::isAuthor($id) !== true){
           JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
           return false;
        }
        $table = $this->getTable();
        if ($table->delete($data['id']) === true) {
            return $id;
        } else {
			$this->setError($table->getError());
            return false;
        }    
        return true;
    }
    
}