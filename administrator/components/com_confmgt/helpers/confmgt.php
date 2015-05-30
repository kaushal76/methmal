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

/**
 * Confmgt helper.
 */
class ConfmgtHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_PAPERS'),
			'index.php?option=com_confmgt&view=papers',
			$vName == 'papers'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_AUTHORS'),
			'index.php?option=com_confmgt&view=authors',
			$vName == 'authors'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_REV1EWERS'),
			'index.php?option=com_confmgt&view=rev1ewers',
			$vName == 'rev1ewers'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_REV1EWS'),
			'index.php?option=com_confmgt&view=rev1ews',
			$vName == 'rev1ews'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_THEMES'),
			'index.php?option=com_confmgt&view=themes',
			$vName == 'themes'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_THEMELEADERS'),
			'index.php?option=com_confmgt&view=themeleaders',
			$vName == 'themeleaders'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_PAYMENTS'),
			'index.php?option=com_confmgt&view=payments',
			$vName == 'payments'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_REGISTRATIONS'),
			'index.php?option=com_confmgt&view=registrations',
			$vName == 'registrations'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_FULLPAPERS'),
			'index.php?option=com_confmgt&view=fullpapers',
			$vName == 'fullpapers'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_CAMERAREADYPAPERS'),
			'index.php?option=com_confmgt&view=camerareadypapers',
			$vName == 'camerareadypapers'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_CONFMGT_TITLE_PRESENTATIONS'),
			'index.php?option=com_confmgt&view=presentations',
			$vName == 'presentations'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_confmgt';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
