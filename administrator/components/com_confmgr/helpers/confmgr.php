<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Confmgr helper class.
 *
 * @package     Confmgr
 * @subpackage  Helpers
 */
class ConfmgrHelper
{
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_PAPER'), 
			'index.php?option=com_confmgr&view=papers', 
			$vName == 'papers'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_ABSTRACT'), 
			'index.php?option=com_confmgr&view=abstracts', 
			$vName == 'abstracts'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_FULL_PAPER'), 
			'index.php?option=com_confmgr&view=full_papers', 
			$vName == 'full_papers'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_CAMERA_READY_PAPER'), 
			'index.php?option=com_confmgr&view=camera_ready_papers', 
			$vName == 'camera_ready_papers'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_PRESENTATION'), 
			'index.php?option=com_confmgr&view=presentations', 
			$vName == 'presentations'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_THEME'), 
			'index.php?option=com_confmgr&view=themes', 
			$vName == 'themes'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_AUTHOR'), 
			'index.php?option=com_confmgr&view=authors', 
			$vName == 'authors'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_REV1EWER'), 
			'index.php?option=com_confmgr&view=rev1ewers', 
			$vName == 'rev1ewers'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_REV1EW'), 
			'index.php?option=com_confmgr&view=rev1ews', 
			$vName == 'rev1ews'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_AUTHOR_FOR_PAPER'), 
			'index.php?option=com_confmgr&view=authors_for_paper', 
			$vName == 'authors_for_paper'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_REV1EWER_FOR_PAPER'), 
			'index.php?option=com_confmgr&view=rev1ewers_for_paper', 
			$vName == 'rev1ewers_for_paper'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_CONFMGR_SUBMENU_PAYMENT'), 
			'index.php?option=com_confmgr&view=payments', 
			$vName == 'payments'
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

		$assetName = 'com_confmgr';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
	

}