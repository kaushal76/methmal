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
 * Paper controller class.
 */
class ConfmgtControllerPaper extends ConfmgtController {
	

    /**
     * Method to check out an item for editing and redirect to the edit form.
     *
     * @since	1.6
     */
    public function edit() {
        $app = JFactory::getApplication();

        // Get the previous edit id (if any) and the current edit id.
        $previousId = (int) $app->getUserState('com_confmgt.edit.paper.id');
        $editId = JFactory::getApplication()->input->getInt('id', null, 'array');

        // Set the user id for the user to edit in the session.
        $app->setUserState('com_confmgt.edit.paper.id', $editId);

        // Get the model.
        $model = $this->getModel('Paper', 'ConfmgtModel');

        // Check out the item
        if ($editId) {
            $model->checkout($editId);
        }

        // Check in the previous user.
        if ($previousId && $previousId !== $editId) {
            $model->checkin($previousId);
        }

        // Redirect to the edit screen.
        $this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=paperform&layout=edit', false));
    }

    /**
     * Method to publish a paper data.
     *
     * @return	void
     * @since	1.6
     */
    public function publish() {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables.
        $app = JFactory::getApplication();
        $model = $this->getModel('Paper', 'ConfmgtModel');

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

        }

        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.paper.id', null);

        // Flush the data from the session.
        $app->setUserState('com_confmgt.edit.paper.data', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('COM_CONFMGT_ITEM_SAVED_SUCCESSFULLY'));
 		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers', false));
    }

    public function remove() {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables.
        $app = JFactory::getApplication();
        $model = $this->getModel('Paper', 'ConfmgtModel');

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
            $app->setUserState('com_confmgt.edit.paper.id', null);

            // Flush the data from the session.
            $app->setUserState('com_confmgt.edit.paper.data', null);
            
            $this->setMessage(JText::_('COM_CONFMGT_ITEM_DELETED_SUCCESSFULLY'));
        }

        // Redirect to the list screen.
		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers', false));
    }
	
	
	public function newAbstract()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('PaperForm', 'ConfmgtModel');
		$authors = $this->getModel ('authors', 'ConfmgtModel');

		// create a new data array.
		$data = array();

		// Attempt to save the data and get the last saved record by the user
		$return	= $model->newAbstract($data);
		
		if ($return) {
        	// Save the new.abstract.id to a session variable
	       	$app->setUserState( 'com_confmgt.new.abstract.id',$return);
			$app->setUserState( 'com_confmgt.linkid',$return);
			$app->setUserState('com_confmgt.edit.paper.email',1);
			
			//Check if there is an authors list; if not redierct to create one
			if (!$authors->getItems()){
				$this->setMessage(JText::_('You need to create a list of authors for your abstracts first', 'warning'));  
				$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=authors', false));
			}else{			
			// redirect to the new abstract page 
       		$this->setRedirect(JRoute::_('index.php?option=com_confmgt&task=paper.edit&id='.$return, false));
			}
		}else{
			// Redirect to the list screen.
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers', false));
		}
        
        // Clear the profile id from the session.
        $app->setUserState('com_confmgt.edit.paper.id', null);


		// Flush the data from the session.
		$app->setUserState('com_confmgt.edit.paper.data', null);
	}
	
	public function downloadFullPaper()
	{
		$app	= JFactory::getApplication();
		$params = JFactory::getApplication()->getParams();
		$filename = $app->input->get('filename');
		$path = $params->get('upload_path').$filename;
		$mime = UploadHelper::getMimetype($path, $filename);
		$dn = UploadHelper::downloadFile($filename, $path, $mime);
	}
	
		public function downloadCameraready()
	{
		$app	= JFactory::getApplication();
		$params = JFactory::getApplication()->getParams();
		$filename = $app->input->get('filename');
		$path = $params->get('upload_path').$filename;
		$mime = UploadHelper::getMimetype($path, $filename);
		$dn = UploadHelper::downloadFile($filename, $path, $mime);
	}
	
		public function downloadPresentation()
	{
		$app	= JFactory::getApplication();
		$params = JFactory::getApplication()->getParams();
		$filename = $app->input->get('filename');
		$path = $params->get('upload_path').$filename;
		$mime = UploadHelper::getMimetype($path, $filename);
		$dn = UploadHelper::downloadFile($filename, $path, $mime);
	}
}
?>