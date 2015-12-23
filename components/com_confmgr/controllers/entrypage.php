<?php

/**
 * @author		Dr Kaushal Keraminiyage
* @copyright	Dr Kaushal Keraminiyage
* @license		GNU General Public License version 2 or later
*/

defined("_JEXEC") or die("Restricted access");

/**
 * Entrypage controller class.
 *
 * @package     Confmgr
 * @subpackage  Controllers
*/
class ConfmgrControllerEntrypage extends JControllerForm
{
	/**
	 * @desc	Method to process the user login 
	 * @return	null
	 */
	public function login()
	{
		$app = JFactory::getApplication();
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');
	
		$model = $this->getModel('Entrypage', 'ConfmgrModel');
		 
		// Validate the posted data.
		//@TODO remove the reference to JERROR and use PHP error handling
		 
		try
		{
			$form = $model->getLoginForm();
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage(),500);
			return false;
		}
		
	
		// Validate the posted data.
		$data = $model->validate($form, $data);
	
		// Check for errors.
	
		if ($data === false) 
		{
			// Get the validation messages.
			$errors	= $model->getErrors();
	
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) 
			{
				if ($errors[$i] instanceof Exception) 
				{
					$app->enqueueMessage($errors[$i]->getMessage(), 'error');
				} 
				else 
				{
					$app->enqueueMessage($errors[$i], 'error');
				}
			}
	
			// Save the data in the session.
			$app->setUserState('com_confmgr.edit.loginform.data', JFactory::getApplication()->input->get('jform', array(), 'array'));
	
			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgr.edit.loginform.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=entrypage&layout=entry_loginmodal&id='.$id, false));
			return false;
		}
	
		jimport( 'joomla.user.authentication');
		$auth = & JAuthentication::getInstance();
		$credentials = array( 'username' => $data['username'], 'password' => $data['pw'] );
		$options = array();
		$response = $auth->authenticate($credentials, $options);
	
		if ($response->status != JAuthentication::STATUS_SUCCESS) 
		{
			$app->enqueueMessage(JText::_('COM_CONFMGR_CONTROLLER_ENTRYPAGE_LOGIN_FAILED'), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=entrypage', false));
		}
		else
		{
			$app->login($credentials);
			$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=entrypage', false));
		}
	}
	
	/**
	 * @desc	Method to process if the user login cancelled at the modal screen
	 * @return	void
	 */
	
	public function cancel() {
		$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=entrypage', false));
	}
}
