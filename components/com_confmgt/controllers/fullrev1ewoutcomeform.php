<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// No direct access
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Paper controller class.
 */
class ConfmgtControllerfullrev1ewoutcomeForm extends ConfmgtController
{

	/**
	 * Method to check out an item for editing and redirect to the edit form.
	 *
	 * @since	1.6
	 */
	public function edit()
	{
		$app = JFactory::getApplication();

		// Get the previous edit id (if any) and the current edit id.
		$previousId = (int) $app->getUserState('com_confmgt.edit.paper.id');
		$editId	= JFactory::getApplication()->input->getInt('id', null, 'array');

		// Set the user id for the user to edit in the session.
		$app->setUserState('com_confmgt.edit.paper.id', $editId);

		// Get the model.
		$model = $this->getModel('fullrev1ewoutcomeForm', 'ConfmgtModel'); 
		$linkid = $model->getLinkid();

		// Check out the item
		if ($editId) {
            $model->checkout($editId);
		}

		// Check in the previous user.
		if ($previousId) {
            $model->checkin($previousId);
		}

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=fullrev1ewoutcomeform&layout=edit', false));
	}

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
		$model = $this->getModel('fullrev1ewoutcomeForm', 'ConfmgtModel');


		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');

		// Validate the posted data.
		$form = $model->getForm();
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}

		// Validate the posted data.
		$data = $model->validate($form, $data);

		// Check for errors.
		if ($data === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.paper.data', JFactory::getApplication()->input->get('jform', array(), 'array'));

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgt.edit.paper.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=fullrev1ewoutcomeform&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->save($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.paper.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.paper.id');
			$this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=fullrev1ewoutcomeform&layout=edit&linkid='.$id, false)); 
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
			
			// send the email to the author
			$email = emailHelper::getEmailcontent ('full_outcome');
			$rawbody = $email->message;
			$rawsubject = $email->subject;
			$id = (int)$app->getUserState('com_confmgt.edit.paper.id');
			$paper = ConfmgtHelper::getPaper($return);
			$paperid = $return;
			
			$recipient = JFactory::getUser((int)$paper->created_by)->email;
			
			$config = JFactory::getConfig();
			$sitename = $config->getValue( 'config.sitename' );
			$site_url=JURI::base();
			
			$authorname = JFactory::getUser((int)$paper->created_by)->name;
			$title = $paper->title;
			$theme = $paper->themename;
			$outcome = JText::_('CONFMGT_FULL_REVIEW_OUTCOME_'.$paper->full_review_outcome);
			$comments = $paper->full_review_comments;
		
			$placeholders = array('NAME'=>$authorname,'TITLE'=>$title, 'SITE'=>$sitename, 'SITE_URL'=>$site_url, 'COMMENTS'=>$comments, 'THEME'=>$theme, 'OUTCOME'=>$outcome, 'PAPERID'=>$paperid );
			$body = emailHelper::replacePlaceholders($placeholders, $comments);
			$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
			emailHelper::sendEmail($recipient, $subject, $body, $sender=0, $cc=0,  $bcc=0, $attachment=0);
			
        }
         
	    // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.paper.id', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
        $this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers&layout=leader_default', false));

		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.paper.data', null);
		$app->setUserState('com_confmgt.new.abstract.id', null);
	}
    
    
    function cancel() {
		$app = JFactory::getApplication();
		$app->setUserState('com_confmgt.edit.paper.data', null);
		$app->setUserState('com_confmgt.new.abstract.id', null);
		$app->setUserState('com_confmgt.edit.paper.id', null);
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers&layout=leader_default', false));
    }
    
	public function remove()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('fullRev1ewoutcomeForm', 'ConfmgtModel');

		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');

		// Validate the posted data.
		$form = $model->getForm();
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}

		// Validate the posted data.
		$data = $model->validate($form, $data);

		// Check for errors.
		if ($data === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.paper.data', $data);

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgt.edit.paper.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=paper&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->delete($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.paper.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.paper.id');
			$this->setMessage(JText::sprintf('Delete failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=paper&layout=edit&id='.$id, false));
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
        
        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.paper.id', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_DELETED_SUCCESSFULLY'));
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers', false));;

		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.paper.data', null);
	}
    
    
}