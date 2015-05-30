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
class ConfmgtControllerRev1ewer extends ConfmgtController {

    /**
     * Method to check out an item for editing and redirect to the edit form.
     *
     * @since	1.6
     */
    public function edit() {
        $app = JFactory::getApplication();

        // Get the previous edit id (if any) and the current edit id.
        $previousId = (int) $app->getUserState('com_confmgt.edit.rev1ewer.id');
        $editId = JFactory::getApplication()->input->getInt('id', null, 'array');

        // Set the user id for the user to edit in the session.
        $app->setUserState('com_confmgt.edit.rev1ewer.id', $editId);

        // Get the model.
        $model = $this->getModel('Rev1ewer', 'ConfmgtModel');

        // Check out the item
        if ($editId) {
            $model->checkout($editId);
        }

        // Check in the previous user.
        if ($previousId && $previousId !== $editId) {
            $model->checkin($previousId);
        }

        // Redirect to the edit screen.
        $this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=edit', false));
    }

    /**
     * Method to save a user's profile data.
     *
     * @return	void
     * @since	1.6
     */
    public function publish() {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables.
        $app = JFactory::getApplication();
        $model = $this->getModel('Rev1ewer', 'ConfmgtModel');

        // Get the user data.
        $data = JFactory::getApplication()->input->get('jform', array(), 'array');

        // Attempt to save the data.
        $return = $model->publish($data['id'], $data['state']);

        // Check for errors.
        if ($return === false) {
            $this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
        } else {
            // Check in the profile.
            if ($return) {
                $model->checkin($return);
            }

            // Clear the profile id from the session.
            $app->setUserState('com_entrusters.edit.bid.id', null);

            // Redirect to the list screen.
            $this->setMessage(JText::_('COM_ENTRUSTERS_ITEM_SAVED_SUCCESSFULLY'));
        }

        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.rev1ewer.id', null);

        // Flush the data from the session.
        $app->setUserState('com_confmgt.edit.rev1ewer.data', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
        $this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
    }

    public function remove() {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables.
        $app = JFactory::getApplication();
        $model = $this->getModel('Rev1ewer', 'ConfmgtModel');

        // Get the user data.
        $data = JFactory::getApplication()->input->get('jform', array(), 'array');

        // Attempt to save the data.
        $return = $model->delete($data['id']);

        // Check for errors.
        if ($return === false) {
            $this->setMessage(JText::sprintf('Delete failed', $model->getError()), 'warning');   
        } else {
            // Check in the profile.
            if ($return) {
                $model->checkin($return);
            }

            // Clear the profile id from the session.
            $app->setUserState('com_confmgt.edit.rev1ewer.id', null);

            // Flush the data from the session.
            $app->setUserState('com_confmgt.edit.rev1ewer.data', null);
            
            $this->setMessage(JText::_('COM_CONFMGT_ITEM_DELETED_SUCCESSFULLY'));
        }

        // Redirect to the list screen.
        $this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewers', false));
    }
	
	
	/**
	 * Method to send the notification emails to reviewers (once the papers are allocated) 
	 * @Since 2.5.3
	 * @return void
	 */
	 
	public function notify() 
	{
		$app = JFactory::getApplication();
		

        // Get the previous edit id (if any) and the current edit id.
        $previousId = (int) $app->getUserState('com_confmgt.notify.rev.id');
        $editId = JFactory::getApplication()->input->getInt('revid', null, 'array');

        // Set the user id for the user to edit in the session.
        $app->setUserState('com_confmgt.notify.rev.id', $editId);


        // Redirect to the edit screen.
        $this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=rev1ewerform&layout=notify_form', false));
	
	}
}
