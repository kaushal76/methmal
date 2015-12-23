<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Paper item controller class.
 *
 * @package     Confmgr
 * @subpackage  Controllers
 */
class ConfmgrControllerPaper extends JControllerForm
{
	/**
	 * The URL view item variable.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $view_item = 'Paper';

	/**
	 * The URL view list variable.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $view_list = 'Papers';
	
	/**
	 * Method to save paper data.
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
		$model = $this->getModel('Paper', 'ConfmgrModel');
	
		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');
	
		// Validate the posted data.
		$form = $model->getForm();
		if (!$form) 
		{
			throw new Exception($model->getError());
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
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} 
				else 
				{
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}
	
			// Save the data in the session.
			$app->setUserState('com_confmgr.edit.paper.data', JFactory::getApplication()->input->get('jform', array(), 'array'));
	
			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgr.edit.paper.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=paper&layout=edit&id='.$id, false));
			return false;
		}
	
	
		// Attempt to save the data.
		$return	= $model->save($data);
	
		// Check for errors.
		if ($return === false) 
		{
			// Save the data in the session.
			$app->setUserState('com_confmgr.edit.paper.data', $data);
	
			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.paper.id');
			$app->enqueueMessage(JText::sprintf('CONFMGR_CONTROLLER_PAPER_SAVE_FALIED', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=paper&layout=edit&id='.$id, false));
			return false;
		}
	
	
		// Check in the paper.
		if ($return) 
		{
			$model->checkin($return);
				
			$emaildue = (int) $data['email_due'];
				
			if ($emaildue) 
			{
					
				//preparing the emails
				$config = JFactory::getConfig();
				$theme = AclHelper::getTheme((int)$data['id']);
					
				if ($data['student_submission'] ==1) 
				{
					//To be changed to Student Coordinator details
					$themeleader = $theme->userid;
					$themeleadername = JFactory::getUser((int)$themeleader)->name;
					$themeleaderemail = JFactory::getUser((int)$themeleader)->email;
						
				}
				else
				{
						
					$themeleader = $theme->userid;
					$themeleadername = JFactory::getUser((int)$themeleader)->name;
					$themeleaderemail = JFactory::getUser((int)$themeleader)->email;
						
				}
				$themetitle = $theme->title;
				$abstract = $data ['abstract'];
				$title = $data ['title'];
				$keywords = $data ['keywords'];
				$title = $data['title'];
				$sitename = $config->getValue( 'config.sitename' );
				$authorname = JFactory::getUser()->name;
				$authoremail = JFactory::getUser()->email;
				$site_url=JURI::base();
				$authors = AclHelper::getAuthors((int)$data['id']);
				$authordetails = '';
				if ($authors) 
				{
					foreach ($authors as $author) 
					{
						$authordetails = $authordetails. $author->title.' '.$author->firstname.' '.$author->surname.'; ';
					}
				}
				//sending email to the author
				$authoremaildata = emailHelper::getEmailcontent ('auth_abs');
				$rawsubject = $authoremaildata->subject;
				$rawbody = $authoremaildata->message;
				$recipient = $authoremail;
					
				//setting placeholders
				$placeholders = array('ABSTRACT'=>$abstract,'NAME'=>$authorname,'TITLE'=>$title, 'KEYWORDS'=>$keywords,'SITE'=>$sitename, 'SITE_URL'=>$site_url, 'AUTHORS'=>$authordetails);
				$body = emailHelper::replacePlaceholders($placeholders, $rawbody);
				$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
					
				emailHelper::sendEmail($recipient, $subject, $body, $sender=0, $cc=0,  $bcc=0, $attachment=0);
					
				//sending the email to the theme leader
				$leaderemaildata = emailHelper::getEmailcontent ('leader_abs');
				$leader_rawsubject = $leaderemaildata->subject;
				$leader_rawbody = $leaderemaildata->message;
				$leader_recipient = $themeleaderemail;
					
				//setting placeholders
				$leader_placeholders = array('ABSTRACT'=>$abstract,'NAME'=>$themeleadername,'TITLE'=>$title, 'KEYWORDS'=>$keywords,'SITE'=>$sitename, 'SITE_URL'=>$site_url, 'AUTHORS'=>$authordetails, 'AUTHOR'=>$authorname, 'THEME'=>$themetitle);
				$leader_body = emailHelper::replacePlaceholders($leader_placeholders, $leader_rawbody);
				$leader_subject = emailHelper::replacePlaceholders($leader_placeholders, $leader_rawsubject);
					
				emailHelper::sendEmail($leader_recipient, $leader_subject, $leader_body, $sender=0, $cc=0,  $bcc=0, $attachment=0);
					
				$app->setUserState('com_confmgt.edit.paper.email',null);
					
			}//email due
		}
	
		// Clear the profile id from the session.
		$app->setUserState('com_confmgr.edit.paper.id', null);
	
		// Redirect to the list screen.
		$this->setMessage(JText::_('COM_CONFMGR_ITEM_SAVED_SUCCESSFULLY'));
		$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=papers', false));
	
		// Flush the data from the session.
		$app->setUserState('com_confmgr.edit.paper.data', null);
		$app->setUserState('com_confmgr.edit.paper.id', null);
	}
	
	public function cancel()
	{
		$app	= JFactory::getApplication();
		// Flush the data from the session.
		$app->setUserState('com_confmgr.edit.paper.data', null);
		$app->setUserState('com_confmgr.edit.paper.id', null);
		$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=papers', false));
	}
	
}
?>