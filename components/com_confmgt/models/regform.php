<?php
/**
 * @version     2.5.8.1
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
class ConfmgtModelRegForm extends JModelForm
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
            $id = JFactory::getApplication()->getUserState('com_confmgt.edit.reg.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_confmgt.edit.reg.id', $id);
        }
		$this->setState('reg.id', $id);

		// Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
            $this->setState('reg.id', $params_array['item_id']);
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

		}

		return $this->_item;
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
		$form = $this->loadForm('com_confmgt.reg', 'regform', array('control' => 'jform', 'load_data' => $loadData));
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
		$data = JFactory::getApplication()->getUserState('com_confmgt.edit.reg.data', array());
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
		
    $user = JFactory::getUser(0); // it's important to set the "0" otherwise your admin user information will be loaded
	
	jimport('joomla.application.component.helper'); // include libraries/application/component/helper.php
	$usersParams = &JComponentHelper::getParams( 'com_users' ); // load the Params
	$userdata = array(); // place user data in an array for storing.

    //set real name
    $userdata['name'] = $data['title'].' '.$data['firstname'].' '.$data['surname'] ;
	$userdata['username'] = $data['username'];
	$userdata['password'] = $data['password'];
	$userdata['email'] = $data['email'];
	
    //set default group.
    $defaultUserGroup = $usersParams->get('new_usertype', 2);

  	//default to defaultUserGroup i.e.,Registered

    $userdata['groups']=array($defaultUserGroup);   
    $userdata['block'] = 0; // set this to 0 so the user will be added immediately.

     //now to add the new user to the database.

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
    
}