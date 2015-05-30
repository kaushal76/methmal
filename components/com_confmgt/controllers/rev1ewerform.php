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
require_once JPATH_COMPONENT . '/controller.php';

/**
 * Rev1ewer controller class.
 */
class ConfmgtControllerRev1ewerForm extends ConfmgtController

{
	/**
	 * Method to check out an item for editing and redirect to the edit form.
	 *
	 * @since	1.6
	 */
	public

	function edit()
	{
		$app = JFactory::getApplication();

		// Get the previous edit id (if any) and the current edit id.

		$previousId = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
		$editId = JFactory::getApplication()->input->getInt('id', null, 'array');

		// Set the user id for the user to edit in the session.

		$app->setUserState('com_confmgt.edit.rev1ewer.id', $editId);

		// Get the model.

		$model = $this->getModel('Rev1ewerForm', 'ConfmgtModel');

		// Check out the item

		if ($editId)
		{
			$model->checkout($editId);
		}

		// Check in the previous user.

		if ($previousId)
		{
			$model->checkin($previousId);
		}

		// Redirect to the edit screen.

		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewer&layout=edit', false));
	}

	/**
	 * Method to save a user's profile data.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public

	function save()
	{

		// Check for request forgeries.

		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.

		$app = JFactory::getApplication();
		$model = $this->getModel('Rev1ewerForm', 'ConfmgtModel');
		$user = JFactory::getUser();

		// Get the user data.

		$data = JFactory::getApplication()->input->get('jform', array() , 'array');
		$edit = $data['id'] > 0;

		// Validate the posted data.

		$form = $model->getForm();
		if (!$form)
		{
			JError::raiseError(500, $model->getError());
			return false;
		}

		// Validate the posted data.

		$data = $model->validate($form, $data);

		// Check for errors.

		if ($data === false)
		{

			// Get the validation messages.

			$errors = $model->getErrors();

			// Push up to three validation messages out to the user.

			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[$i] instanceof Exception)
				{
					$app->enqueueMessage($errors[$i]->getMessage() , 'warning');
				}
				else
				{
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.

			$app->setUserState('com_confmgt.edit.rev1ewer.data', JRequest::getVar('jform') , array());

			// Redirect back to the edit screen.

			$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
			return false;
		}

		if (!$edit) // not in the edit mode, hence a new reviewer
		{

			// Check if there is a registered user with the same email,

			$userexists = AclHelper::getUserID($data['email']);

			// email is registered

			if ($userexists > 0)
			{

				// Check if there is a reviewer with the same email in the reviewers table,

				$reviewerexists = AclHelper::getRev1ewerID($data['email']);

				// reviewer is present in the reviewers table

				if (!($reviewerexists == false))
				{

					// reviewer has previously denied to be part of the conference

					if ($reviewerexists->agreed == 0)
					{

						// Redirect to the list screen.

						$this->setMessage(JText::_('COM_CONFMGT_REV_DENIED'));
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
						return false;
					}
					elseif ($reviewerexists->agreed == 1)
					{ //reviewer agreed and already in the system
						$this->setMessage(JText::_('COM_CONFMGT_REV_ACCEPTED'));
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
						return true;
					}
					else
					{ //reviewer must have received an invitation but has not accepted or rejected yet.
						$this->setMessage(JText::_('COM_CONFMGT_REV_AWAITING'));
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
						return false;
					}
				}
				else
				{ //user exists but not as a reviewer in the reviewer table. We have to create a new reviewer and assign the existing userid.
					$data['userid'] = $userexists;

					// Attempt to save the data.

					$return = $model->save($data);

					// Check for errors.

					if ($return === false)
					{

						// Save the data in the session.

						$app->setUserState('com_confmgt.edit.rev1ewer.data', $data);

						// Redirect back to the edit screen.

						$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
						$this->setMessage(JText::sprintf('Save failed', $model->getError()) , 'warning');
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
						return false;
					}

					// Check in the profile.

					if ($return)
					{
						$model->checkin($return);
					}

					// get the random number in the agreed column

					$agreedstatus = $model->getRow($return)->agreed;
					if (!($agreedstatus === 1))
					{ // reviewer has not agreed in advance
						$name = $data['title'] . ' ' . $data['firstname'] . ' ' . $data['surname'];

						// sending the welcome email to the user

						$emaildata = emailHelper::getEmailcontent('rev_agree');
						$rawsubject = $emaildata->subject;
						$recipient = $data['email'];
						$config = JFactory::getConfig();
						$sitename = $config->getValue('config.sitename');
						$rawbody = $emaildata->message;
						$agreelink = JURI::base() . 'index.php?option=com_confmgt&view=rev1ewerform&task=rev1ewerform.agree&rnd=' . $agreedstatus;
						$denylink = JURI::base() . 'index.php?option=com_confmgt&view=rev1ewerform&task=rev1ewerform.reject&rnd=' . $agreedstatus;
						$theme_leader = $user->name;

						// setting placeholders

						$placeholders = array(
							'NAME' => $name,
							'SITE' => $sitename,
							'AGREE_LINK' => $agreelink,
							'DENY_LINK' => $denylink,
							'THEME_LEADER' => $theme_leader
						);
						$body = emailHelper::replacePlaceholders($placeholders, $rawbody);
						$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
						$cc = "k.keraminiyage@hud.ac.uk";
						$emailsent = emailHelper::sendEmail($recipient, $subject, $body, $sender = 0, $cc, $bcc = 0, $attachment = 0);
						if (!$emailsent)
						{
							$app->setUserState('com_confmgt.edit.rev1ewer.data', $data);
							$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
							$deletedata = array();
							$deletedata['id'] = $return;

							// Delete the recently saved record

							$model->delete($deletedata);

							// Redirect back to the edit screen.

							$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
							return false;
						}

						// Clear the profile id from the session.

						$app->setUserState('com_confmgt.edit.rev1ewer.id', null);

						// Redirect to the list screen.

						$this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));

						// Flush the data from the session.

						$app->setUserState('com_confmgt.edit.rev1ewer.data', null);
						return true;
					}
					else
					{ //Reviewer has agreed in advance

						// sending the welcome email to the user

						$emaildata = emailHelper::getEmailcontent('rev_welcome');
						$rawsubject = $emaildata->subject;
						$recipient = $data['email'];
						$config = JFactory::getConfig();
						$name = $data['title'] . ' ' . $data['firstname'] . ' ' . $data['surname'];
						$sitename = $config->getValue('config.sitename');
						$rawbody = $emaildata->message;
						$theme_leader = $user->name;

						// setting placeholders

						$placeholders = array(
							'NAME' => $name,
							'SITE_NAME' => $sitename,
							'THEME_LEADER' => $theme_leader
						);
						$body = emailHelper::replacePlaceholders($placeholders, $rawbody);
						$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
						$emailsent = emailHelper::sendEmail($recipient, $subject, $body, $sender = 0, $cc = 0, $bcc = 0, $attachment = 0);
						If (!$emailsent)
						{
							$app->setUserState('com_confmgt.edit.rev1ewer.data', $data);
							$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
							$deletedata = array();
							$deletedata['id'] = $return;

							// Delete the recently saved record

							$model->delete($deletedata);

							// Redirect back to the edit screen.

							$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
							return false;
						}

						// Clear the profile id from the session.

						$app->setUserState('com_confmgt.edit.rev1ewer.id', null);

						// Redirect to the list screen.

						$this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));

						// Flush the data from the session.

						$app->setUserState('com_confmgt.edit.rev1ewer.data', null);
						return true;

						// to send an email to the user about the new role

					}
				}
			}
			else
			{ //user does not exist
				$data['userid'] = 0;

				// Attempt to save the data.

				$return = $model->save($data);

				// Check for errors.

				if ($return === false)
				{

					// Save the data in the session.

					$app->setUserState('com_confmgt.edit.rev1ewer.data', $data);

					// Redirect back to the edit screen.

					$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
					$this->setMessage(JText::sprintf('Save failed', $model->getError()) , 'warning');
					$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
					return false;
				}

				// Check in the profile.

				if ($return)
				{
					$model->checkin($return);
				}

				// get the random number in the agreed column

				$agreedstatus = $model->getRow($return)->agreed;
				if (!($agreedstatus === 1))
				{ // reviewer has not agreed in advance
					$name = $data['title'] . ' ' . $data['firstname'] . ' ' . $data['surname'];

					// sending the welcome email to the user

					$emaildata = emailHelper::getEmailcontent('rev_agree');
					$rawsubject = $emaildata->subject;
					$recipient = $data['email'];
					$config = JFactory::getConfig();
					$sitename = $config->getValue('config.sitename');
					$rawbody = $emaildata->message;
					$agreelink = JURI::base() . 'index.php?option=com_confmgt&view=rev1ewerform&task=rev1ewerform.agree&rnd=' . $agreedstatus;
					$denylink = JURI::base() . 'index.php?option=com_confmgt&view=rev1ewerform&task=rev1ewerform.reject&rnd=' . $agreedstatus;
					$theme_leader = $user->name;

					// setting placeholders

					$placeholders = array(
						'NAME' => $name,
						'SITE' => $sitename,
						'AGREE_LINK' => $agreelink,
						'DENY_LINK' => $denylink,
						'THEME_LEADER' => $theme_leader
					);
					$body = emailHelper::replacePlaceholders($placeholders, $rawbody);
					$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
					$emailsent = emailHelper::sendEmail($recipient, $subject, $body, $sender = 0, $cc = 0, $bcc = 0, $attachment = 0);
					if (!$emailsent)
					{
						$app->setUserState('com_confmgt.edit.rev1ewer.data', $data);
						$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
						$deletedata = array();
						$deletedata['id'] = $return;

						// Delete the recently saved record

						$model->delete($deletedata);

						// Redirect back to the edit screen.

						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
						return false;
					}

					// Clear the profile id from the session.

					$app->setUserState('com_confmgt.edit.rev1ewer.id', null);

					// Redirect to the list screen.

					$this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
					$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));

					// Flush the data from the session.

					$app->setUserState('com_confmgt.edit.rev1ewer.data', null);
					return true;
				}
				else
				{ //Reviewer agreed in advance
					if ($revdata['userid'] = $this->_newRevEmail($data))
					{
						$revdata['id'] = $return;
						$return = $model->save($revdata);

						// Check for errors.

						if ($return === false)
						{

							// Save the data in the session.

							$app->setUserState('com_confmgt.edit.rev1ewer.data', $data);

							// Redirect back to the edit screen.

							$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
							$this->setMessage(JText::sprintf('Save failed', $model->getError()) , 'warning');
							$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
							return false;
						}

						// Check in the profile.

						if ($return)
						{
							$model->checkin($return);
						}

						// Clear the profile id from the session.

						$app->setUserState('com_confmgt.edit.rev1ewer.id', null);

						// Redirect to the list screen.

						$this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));

						// Flush the data from the session.

						$app->setUserState('com_confmgt.edit.rev1ewer.data', null);
					}
				}
			}
		}
		else
		{ //reviewer record in the edit mode, hence no need to generate the emails, etc
			$return = $model->save($data);

			// Check for errors.

			if ($return === false)
			{

				// Save the data in the session.

				$app->setUserState('com_confmgt.edit.rev1ewer.data', $data);

				// Redirect back to the edit screen.

				$id = (int)$app->getUserState('com_confmgt.edit.rev1ewer.id');
				$this->setMessage(JText::sprintf('Save failed', $model->getError()) , 'warning');
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit&id=' . $id, false));
				return false;
			}

			// Check in the profile.

			if ($return)
			{
				$model->checkin($return);
			}

			// Clear the profile id from the session.

			$app->setUserState('com_confmgt.edit.rev1ewer.id', null);

			// Redirect to the list screen.

			$this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));

			// Flush the data from the session.

			$app->setUserState('com_confmgt.edit.rev1ewer.data', null);
			return true;
		}
	}

	function cancel()
	{
		$app = JFactory::getApplication();
		$app->setUserState('com_confmgt.edit.rev1ewer.data', null);
		$app->setUserState('com_confmgt.edit.rev1ewer.id', null);
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
	}

	public

	function remove()
	{

		// Check for request forgeries.

		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.

		$app = JFactory::getApplication();
		$model = $this->getModel('Rev1ewerForm', 'ConfmgtModel');

		// Get the user data.

		$data = JFactory::getApplication()->input->get('jform', array() , 'array');

		// Attempt to save the data.

		$return = $model->delete($data);

		// Clear the profile id from the session.

		$app->setUserState('com_confmgt.edit.rev1ewer.id', null);

		// Redirect to the list screen.

		if ($return)
		{
			$this->setMessage(JText::_('COM_CONFMGT_ITEM_DELETED_SUCCESSFULLY'));
		}
		else
		{
			$this->setMessage(JText::_('COM_CONFMGT_COULD_NOT_DELETE_ITEM'));
		}

		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));

		// Flush the data from the session.

		$app->setUserState('com_confmgt.edit.rev1ewer.data', null);
	}

	public

	function agree()
	{
		$rnd = JFactory::getApplication()->input->get('rnd', 0, 'int');
		$model = $this->getModel('Rev1ewerForm', 'ConfmgtModel');
		if ($rnd == 0)
		{
			$this->setMessage(JText::_('COM_CONFMGT_LINK_INVALID'));
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
			return false;
		}

		$details = $model->getRev1ewerDetails($rnd);
		if (!$details)
		{
			$this->setMessage(JText::_('COM_CONFMGT_LINK_INVALID'));
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
			return false;
		}
		else
		{
			$userexists = AclHelper::getUserID($details->email);
			if (!$userexists)
			{

				// Creating the user account

				$userdata = array();
				$userdata['name'] = $details->title . ' ' . $details->firstname . ' ' . $details->surname;
				$userdata['email'] = $details->email;
				$userdata['username'] = $details->email;
				$userdata['password'] = md5(time());
				$usercreated = $model->saveUser($userdata);
				if (!$usercreated)
				{
					$this->setMessage(JText::_('COM_CONFMGT_USER_NOT_CREATED'));
					$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
					return false;
				}
				else
				{
					$userid = AclHelper::getUserID($details->email);
					$name = $userdata['name'];
					$username = $userdata['username'];
					$password = $userdata['password'];

					// sending the welcome email to the user

					$emaildata = emailHelper::getEmailcontent('regemail');
					$rawsubject = $emaildata->subject;
					$recipient = $userdata['email'];
					$config = JFactory::getConfig();
					$sitename = $config->getValue('config.sitename');
					$rawbody = $emaildata->message;

					// setting placeholders

					$placeholders = array(
						'NAME' => $name,
						'USERNAME' => $username,
						'PASSWORD' => $password,
						'SITE' => $sitename
					);
					$body = emailHelper::replacePlaceholders($placeholders, $rawbody);
					$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
					$mailsent = emailHelper::sendEmail($recipient, $subject, $body, $sender = 0, $cc = 0, $bcc = 0, $attachment = 0);
					if (!$mailsent)
					{
						$this->setMessage(JText::_('COM_CONFMGT_REG_EMAIL_NOT_SENT'));
						$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
						return false;
					}
					else
					{
						$saved = $model->agree($details->id, $userid);
						if (!$saved)
						{
							$this->setMessage(JText::_('COM_CONFMGT_REV_DATABASE_NOT_UPDATED'));
							$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
							return false;
						}
						else
						{
							$this->setMessage(JText::_('COM_CONFMGT_AGREED_SUCCESS'));
							$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
							return true;
						}
					}
				}
			}
			else
			{ //user exists
				$saved = $model->agree($details->id);
				if (!$saved)
				{
					$this->setMessage(JText::_('COM_CONFMGT_REV_DATABASE_NOT_UPDATED'));
					$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
					return false;
				}
				else
				{
					$this->setMessage(JText::_('COM_CONFMGT_AGREED_SUCCESS_EXISTS'));
					$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
					return true;
				}
			}
		}
	}

	public

	function reject()
	{
		$rnd = JFactory::getApplication()->input->get('rnd', 0, 'int');
		$model = $this->getModel('Rev1ewerForm', 'ConfmgtModel');
		if ($rnd == 0)
		{
			$this->setMessage(JText::_('COM_CONFMGT_LINK_INVALID'));
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewersform&layout=agree_form', false));
			return false;
		}

		$details = $model->getRev1ewerDetails($rnd);
		if (!$details)
		{
			$this->setMessage(JText::_('COM_CONFMGT_LINK_INVALID'));
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
			return false;
		}
		else
		{
			$saved = $model->reject($details->id);
			if (!$saved)
			{
				$this->setMessage(JText::_('COM_CONFMGT_REV_DATABASE_NOT_UPDATED'));
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
				return false;
			}
			else
			{
				$this->setMessage(JText::_('COM_CONFMGT_REJECT_SUCCESS'));
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=agree_form', false));
				return true;
			}
		}
	}

	private
	function _newRevEmail($details)
	{
		$model = $this->getModel('Rev1ewerForm', 'ConfmgtModel');

		// Creating the user account

		$userdata = array();
		$userdata['name'] = $details['title'] . ' ' . $details['firstname'] . ' ' . $details['surname'];
		$userdata['email'] = $details['email'];
		$userdata['username'] = $details['email'];
		$userdata['password'] = md5(time());
		$usercreated = $model->saveUser($userdata);
		if (!$usercreated)
		{
			$this->setMessage(JText::_('COM_CONFMGT_USER_NOT_CREATED'));
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform', false));
			return false;
		}
		else
		{
			$userid = AclHelper::getUserID($details['email']);
			$name = $userdata['name'];
			$username = $userdata['username'];
			$password = $userdata['password'];

			// sending the welcome email to the user

			$emaildata = emailHelper::getEmailcontent('regemail');
			$rawsubject = $emaildata->subject;
			$recipient = $userdata['email'];
			$config = JFactory::getConfig();
			$sitename = $config->getValue('config.sitename');
			$siteurl = JURI::root();
			$rawbody = $emaildata->message;

			// setting placeholders

			$placeholders = array(
				'NAME' => $name,
				'USERNAME' => $username,
				'PASSWORD' => $password,
				'SITE' => $sitename,
				'SITEURL' => $siteurl
			);
			$body = emailHelper::replacePlaceholders($placeholders, $rawbody);
			$subject = emailHelper::replacePlaceholders($placeholders, $rawsubject);
			$mailsent = emailHelper::sendEmail($recipient, $subject, $body, $sender = 0, $cc = 0, $bcc = 0, $attachment = 0);
			if (!$mailsent)
			{
				$this->setMessage(JText::_('COM_CONFMGT_REG_EMAIL_NOT_SENT'));
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform', false));
				return false;
			}
			else
			{
				$this->setMessage(JText::_('Reviewer added successfully'));
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
				return $userid;
			}
		}
	}

	public

	function notify()
	{

		// Check for request forgeries.

		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.

		$app = JFactory::getApplication();
		$model = $this->getModel('Rev1ewerForm', 'ConfmgtModel');

		// Get the user data.

		$data = JFactory::getApplication()->input->get('jform', array() , 'array');

		// Validate the posted data.

		$form = $model->getFormNotification();
		if (!$form)
		{
			JError::raiseError(500, $model->getError());
			return false;
		}

		// Validate the posted data.

		$data = $model->validate($form, $data);
		print_r($data);
		die();
		if ($data)
		{
			$body = $data['body'];
			$subject = $data['subject'];
			$recipient = $data['email'];
			$mailsent = emailHelper::sendEmail($recipient, $subject, $body, $sender = 0, $cc = 0, $bcc = 0, $attachment = 0);
			if (!$mailsent)
			{
				$this->setMessage(JText::_('Reviewer cound not be notified successfully. Email failed.'));
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
				return false;
			}
			else
			{
				$this->setMessage(JText::_('Reviewer is notified successfully'));
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
				return $userid;
			}
		}
	}
}
