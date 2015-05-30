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
 * Abstract controller class.
 */
class ConfmgtControllerAbstractForm extends ConfmgtController
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
		$previousId = (int) $app->getUserState('com_confmgt.edit.abstract.id');
		$editId	= JFactory::getApplication()->input->getInt('id', null, 'array');

		// Set the user id for the user to edit in the session.
		$app->setUserState('com_confmgt.edit.abstract.id', $editId);

		// Get the model.
		$model = $this->getModel('AbstractForm', 'ConfmgtModel');

		// Check out the item
		if ($editId) {
            $model->checkout($editId);
		}

		// Check in the previous user.
		if ($previousId) {
            $model->checkin($previousId);
		}

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=abstractform&layout=edit', false));
	}

	/**
	 * Method to save abstract data.
	 *
	 * @return	void
	 * @since	1.6
	 */
	private function save_common($url_success, $url_fail)
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('AbstractForm', 'ConfmgtModel');
		

		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array'); 


		// Get the form.
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
			$app->setUserState('com_confmgt.edit.abstract.data', JRequest::getVar('jform'),array());

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_confmgt.edit.abstract.id');
			$this->setRedirect($url_fail, false);
			
			//$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=authorform&layout=edit&id='.$id, false));
			return false;
		}

		
		// Attempt to save the data.
		$return	= $model->save($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_confmgt.edit.abstract.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_confmgt.edit.abstract.id');
			$this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
			
			$this->setRedirect(JRoute::_($url_fail.$id, false));
			
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
        
		
        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.abstract.id', null);
		$app->setUserState('com_confmgt.edit.abstract.data', null);

 
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
		$this->setRedirect(JRoute::_($url_success, false));

		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.abstract.data', null);
	}
    
	public function save() {
		$app	= JFactory::getApplication();
		$model = $this->getModel('AbstractForm', 'ConfmgtModel');
		$linkid = $model->getLinkid();
		$url_success = 'index.php?option=com_confmgt&view=paper&id='.$linkid;
		$url_fail = 'index.php?option=com_confmgt&view=abstractform&layout=edit&id=';
		
		$this->save_common($url_success, $url_fail);
	}
	
    
    function cancel() {
		
	    // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.abstract.id', null);
		$app->setUserState('com_confmgt.edit.abstract.data', null);
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers', false));
    }
    
}