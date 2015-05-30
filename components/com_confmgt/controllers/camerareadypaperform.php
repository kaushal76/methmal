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
 * Camerareadypaper controller class.
 */
class ConfmgtControllerCamerareadypaperForm extends ConfmgtController
{

	/**
	 * Method to check out an item for editing and redirect to the edit form.
	 *
	 * @since	1.6
	 */
	public function edit()
	{
		$app			= JFactory::getApplication();

		// Get the previous edit id (if any) and the current edit id.
		$previousId = (int) $app->getUserState('com_confmgt.edit.camerareadypaper.id');
		$editId	= JFactory::getApplication()->input->getInt('id', null, 'array');

		// Set the user id for the user to edit in the session.
		$app->setUserState('com_confmgt.edit.camerareadypaper.id', $editId);

		// Get the model.
		$model = $this->getModel('CamerareadypaperForm', 'ConfmgtModel');

		// Check out the item
		if ($editId) {
            $model->checkout($editId);
		}

		// Check in the previous user.
		if ($previousId) {
            $model->checkin($previousId);
		}

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=camerareadypaper&layout=edit', false));
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
		$model = $this->getModel('CamerareadypaperForm', 'ConfmgtModel');

		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');
		
		//Get files input for validation
		$data['camera_ready'] = JFactory::getApplication()->input->files->get('jform');

		// Validate the posted data.
		$form = $model->getForm();
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}
		
		//get Link ID
		$linkid = $model->getLinkid();

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
			$app->setUserState('com_confmgt.edit.camerareadypaper.data', JRequest::getVar('jform'),array());

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgt.edit.camerareadypaper.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=camerareadypaperform&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->save($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.camerareadypaper.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.camerareadypaper.id');
			$this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=camerareadypaperform&layout=edit&id='.$id, false));
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
        
        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.camerareadypaper.id', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
        $item = 'index.php?option=com_confmgt&view=paper&id='.$linkid;
        $this->setRedirect(JRoute::_($item, false));

		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.camerareadypaper.data', null);
	}
    
    
    function cancel() {
		$model = $this->getModel('CamerareadypaperForm', 'ConfmgtModel');
		$linkid = $model->getLinkid();
		
	    $link = 'index.php?option=com_confmgt&view=paper&id='.$linkid;
        $this->setRedirect(JRoute::_($link, false));
    }
    
	public function remove()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('CamerareadypaperForm', 'ConfmgtModel');

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
			$app->setUserState('com_confmgt.edit.camerareadypaper.data', $data);

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgt.edit.camerareadypaper.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=camerareadypaper&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->delete($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.camerareadypaper.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.camerareadypaper.id');
			$this->setMessage(JText::sprintf('Delete failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=camerareadypaper&layout=edit&id='.$id, false));
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
        
        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.camerareadypaper.id', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_DELETED_SUCCESSFULLY'));
        $link = 'index.php?option=com_confmgt&view=camerareadypapers&linkid='.$linkid;
        $this->setRedirect(JRoute::_($link, false));


		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.camerareadypaper.data', null);
	}
    
    
}