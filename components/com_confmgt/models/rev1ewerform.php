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
class ConfmgtModelRev1ewerForm extends JModelForm
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
            $id = JFactory::getApplication()->getUserState('com_confmgt.edit.rev1ewer.id');
        } elseif (JFactory::getApplication()->input->get('layout') == 'notify_form') {
            $id = JFactory::getApplication()->getUserState('com_confmgt.notify.rev.id'); 
		}else{
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_confmgt.edit.rev1ewer.id', $id);
        }
		$this->setState('rev1ewer.id', $id);

		// Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
            $this->setState('rev1ewer.id', $params_array['item_id']);
        }
		$this->setState('params', $params);

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
				$id = $this->getState('rev1ewer.id');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
                
                $user = JFactory::getUser();
                $id = $table->id;
                           
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
	
	
		/**
	 * Method to get the agreed status.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function getRow($id = null)
	{
				
			if ($id == null) {
				
					$id = JFactory::getApplication()->input->get('id');
			}
			
			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$return = JArrayHelper::toObject($properties, 'JObject');
			} elseif ($error = $table->getError()) {
				$this->setError($error);
				$return = false;
		}

		return $return;
	}
    
	public function getTable($type = 'Rev1ewer', $prefix = 'ConfmgtTable', $config = array())
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
		$id = (!empty($id)) ? $id : (int)$this->getState('rev1ewer.id');

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
		$id = (!empty($id)) ? $id : (int)$this->getState('rev1ewer.id');

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
		$form = $this->loadForm('com_confmgt.rev1ewer', 'rev1ewerform', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}
	
	public function getFormNotification($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_confmgt.revnotification', 'revnotificationform', array('control' => 'jform', 'load_data' => $loadData));
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
		$data = JFactory::getApplication()->getUserState('com_confmgt.edit.rev1ewer.data', array());
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
		$id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('rev1ewer.id');
        $state = (!empty($data['state'])) ? 1 : 0;
        $user = JFactory::getUser();
		$data['created_by'] = $user->id;
		
		if ((!$data['agreed'] == 1)&&($data['id'] ==0))
		{
			$data['agreed'] = time();
		}
        
        $table = $this->getTable();
        if ($table->save($data) === true) {
            return $table->id;
        } else {
			$this->setError($table->getError());
            return false;
        }
        
	}
	
	public function agree($id, $userid = 0)
	{
		$user = JFactory::getUser();
		
		
		$data = array();
		$data['id'] = $id;
		$data['agreed'] = 1;
		
		if ($userid >0) {
			$data['userid'] = $userid;
		}
		
        $table = $this->getTable();
        if ($table->save($data) === true) {
            return true;
        } else {
			$this->setError($table->getError());
            return false;
        }
        
	}
	
	public function reject($id, $userid=0)
	{
		$user = JFactory::getUser();

		$data = array();
		$data['id'] = $id;
		$data['agreed'] = 0;
		
		if ($userid >0) {
			$data['userid'] = $userid;
		}
		
        $table = $this->getTable();
        if ($table->save($data) === true) {
            return true;
        } else {
			$this->setError($table->getError());
            return false;
        }
        
	}
    
     function delete($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('rev1ewer.id');
       
        $table = $this->getTable();
        if ($table->delete($data['id']) === true) {
            return true;
        } else {
			$this->setError($table->getError());
            return false;
        }
        
        return true;
    }
	
		/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function saveUser($userdata)
	
	{
		
    $user = JFactory::getUser(0); // it's important to set the "0" otherwise your admin user information will be loaded
	
	jimport('joomla.application.component.helper'); // include libraries/application/component/helper.php
	$usersParams = &JComponentHelper::getParams( 'com_users' ); // load the Params
	
    //set default group.
    $defaultUserGroup = $usersParams->get('new_usertype', 2);

  	//default to defaultUserGroup i.e.,Registered

    $userdata['groups']=array($defaultUserGroup);   
    $userdata['block'] = 0; // set this to 0 so the user will be added immediately.

     //now to add the new user to the dtabase.

		if (!$user->bind($userdata)) { // bind the data and if it fails raise an error
	
		 JError::raiseWarning('', JText::_( $user->getError())); // something went wrong!!
			return false;
		}
	
		if (!$user->save()) { // now check if the new user is saved
		 JError::raiseWarning('', JText::_( $user->getError())); // something went wrong!!  
			return false;
		}
	 
	return true;

	}
	
		//Function to get Reviewer ID by the agree column random number
	public static function getRev1ewerDetails($rnd)
	{
		//Obtain a database connection
		$db = JFactory::getDbo();
		$user = JFactory::getUser();
		
			//Build the query 
			$query = $db->getQuery(true)
						->select($db->quoteName(array('a.id', 'a.userid', 'a.email', 'a.agreed', 'a.title', 'a.firstname', 'a.surname' ))) 
						->from($db->quoteName('#__confmgt_rev1ewers', 'a'))
						->where($db->quoteName('agreed').' = '.(int)$rnd);
			
		//Prepare the query
		$db->setQuery($query);
		$row = $db->loadObject();
		if ($row) {
			return $row;
		}else{
			return false;
		}
		
	}
    
}