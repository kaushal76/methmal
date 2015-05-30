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
 * File upload controller class.
 */
class ConfmgtControllerUploadForm extends ConfmgtController
{

	/**
	 * Method to save a an uploaded file.
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
		$model = $this->getModel('UploadForm', 'ConfmgtModel');

		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');
		
		//Get files input for validation
		$data['full_paper'] = JFactory::getApplication()->input->files->get('jform');
		
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
			$app->setUserState('com_confmgt.edit.fullpaper.data', JRequest::getVar('jform'),array());

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgt.edit.fullpaper.id');
			
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=fullpaperform&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->save($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.fullpaper.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.fullpaper.id');
			$this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=fullpaperform&layout=edit&id='.$id, false));
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
	        
        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.fullpaper.id', null);
		$app->setUserState('com_confmgt.edit.fullpaper.linkid', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
        $item = 'index.php?option=com_confmgt&view=paper&id='.$linkid;
        $this->setRedirect(JRoute::_($item, false));

		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.fullpaper.data', null);
		
	}
    
    
    function cancel() {
		
		//get model and Link ID
		$model = $this->getModel('FullpaperForm', 'ConfmgtModel');
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
		$model = $this->getModel('FullpaperForm', 'ConfmgtModel');
		//get Link ID
		$linkid = $model->getLinkid();

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
			$app->setUserState('com_confmgt.edit.fullpaper.data', $data);

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgt.edit.fullpaper.id');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=fullpaper&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->delete($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.fullpaper.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.fullpaper.id');
			$this->setMessage(JText::sprintf('Delete failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=fullpaper&layout=edit&id='.$id, false));
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
        
        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.fullpaper.id', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_DELETED_SUCCESSFULLY'));
        $link = 'index.php?option=com_confmgt&view=fullpapers&linkid='.$linkid;
        $this->setRedirect(JRoute::_($link, false));

		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.fullpaper.data', null);
	}
    
    
}