<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

// No direct access
defined('_JEXEC') or die;

class ConfmgrControllerRegForm extends JControllerForm
{
	/**
	 * The URL view item variable.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $view_item = 'regform';

	/**
	 * The URL view list variable.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $view_list = 'entrypage';
	
	/**
	 * Method to save a user's profile data.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public function save()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('RegForm', 'ConfmgrModel');
	
		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');
	
		try 
		{
			$form = $model->getForm();
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
			//@TODO - replace JError
			$errors	= $model->getErrors();
	
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) 
			{
				if ($errors[$i] instanceof Exception) 
				{
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} 
				else 
				{
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}
	
			// Save the data in the session.
			$app->setUserState('com_confmgr.edit.regform.data', JFactory::getApplication()->input->get('jform', array(), 'array'));
	
			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgr.edit.regform.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=regform&layout=edit&id='.$id, false));
			return false;
		}
	
		// Attempt to save the data.
		$return	= $model->save($data);
	
		// Check for errors.
		if ($return === false) 
		{
			// Save the data in the session.
			$app->setUserState('com_confmgr.edit.regform.data', $data);
			
			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgr.edit.regform.id');
			
			//@TODO - replace JError
			$errors	= $model->getErrors();
			
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[$i] instanceof Exception)
				{
					$app->enqueueMessage($errors[$i]->getMessage().' '.JText::_('COM_CONFMGR_CONTROLLER_REGFORM_AUTHOR_SAVE_FAILED'), 'Error');
				}
				else
				{
					$app->enqueueMessage($errors[$i].' '.JText::_('COM_CONFMGR_CONTROLLER_REGFORM_AUTHOR_SAVE_FAILED'), 'Error');
				}
			}
			
			$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=regform&layout=edit&id='.$id, false));
			return false;
		}
	
		$name = $data['title'].' '.$data['firstname'].' '.$data['surname'];
		$username = $data['username'];
		$password = $data['password'];
		$site_url=JURI::base();
	
		// Clear the profile id from the session.
		$app->setUserState('com_confmgr.edit.regform.id', null);
		$credentials = array( 'username' => $data['username'], 'password' => $data['password'] );
	
		// Redirect to the list screen.
		$this->setMessage(JText::_('COM_CONFMGR_CONTROLLER_REGFORM_USER_SUCCESSFULLY_CREATED'));
		$app->login($credentials);
		
		/*
	
		//sending the welcome email to the user
		$emaildata = emailHelper::getEmailcontent ('regemail');
		$rawsubject = $emaildata->subject;
		$recipient = $data['email'];
	
		$config = JFactory::getConfig();
		$sitename = $config->getValue( 'config.sitename' );
		$rawbody = $emaildata->message;
	
		//setting placeholders
		$placeholders = array('NAME'=>$name,'USERNAME'=>$username,'PASSWORD'=>$password,'SITE'=>$sitename, 'SITEURL'=>$site_url);
	
		$body = emailHelper::replacePlaceholders($placeholders, $rawbody);
		$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
	
		emailHelper::sendEmail($recipient, $subject, $body, $sender=0, $cc=0,  $bcc=0, $attachment=0);
		
		*/
			
		$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=entrypage', false));
	
		// Flush the data from the session.
		$app->setUserState('com_confmgr.edit.regform.data', null);
		$app->setUserState('com_confmgr.edit.regform.id', null);
	}
	
	
	function cancel() {
		$app	= JFactory::getApplication();
		$app->setUserState('com_confmgr.edit.regform.id', null);
		$app->setUserState('com_confmgr.edit.regform.data', null);
		$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=entrypage', false));
	}
	
}
