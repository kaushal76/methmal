<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Authors list controller class.
 */
class ConfmgtControllerAuthors extends ConfmgtController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Authors', $prefix = 'ConfmgtModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	

	/**
	 * Changes the order of one or more records.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function reorder()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$ids = JFactory::getApplication()->input->get('cid', null, 'array');
		$inc = ($this->getTask() == 'orderup') ? -1 : +1;

		$model = $this->getModel();
		$linkid = $model->getlinkid();
		$return = $model->reorder($ids, $inc);
		if ($return === false)
		{
			// Reorder failed.
			$message = JText::sprintf('JLIB_APPLICATION_ERROR_REORDER_FAILED', $model->getError());
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=authors&layout=reorder&linkid='.$linkid, false), $message, 'error');
			return false;
		}
		else
		{
			// Reorder succeeded.
			$message = JText::_('JLIB_APPLICATION_SUCCESS_ITEM_REORDERED');
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=authors&layout=reorder&linkid='.$linkid, false), $message);
			return true;
		}
	}

	/**
	 * Method to save the submitted ordering values for records.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function saveorder()
	{
		// Check for request forgeries.
		//JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Get the input
		$pks = JFactory::getApplication()->input->get('cid', null, 'array');
		$order = JFactory::getApplication()->input->get('order', null,'array');
		

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();
		$linkid = $model->getlinkid();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return === false)
		{
			// Reorder failed
			$message = JText::sprintf('JLIB_APPLICATION_ERROR_REORDER_FAILED', $model->getError());
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=authors&layout=reorder&linkid='.$linkid, false), $message, 'error');
			return false;
		}
		else
		{
			// Reorder succeeded.
			$this->setMessage(JText::_('JLIB_APPLICATION_SUCCESS_ORDERING_SAVED'));
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=authors&layout=reorder&linkid='.$linkid, false));
			return true;
		}
	}
}