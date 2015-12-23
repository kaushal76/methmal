<?php
/**
 * @version		0.0.5
 * @package		com_confmgr
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/confmgr.php';
require_once JPATH_COMPONENT_SITE.'/helpers/route.php';
require_once JPATH_COMPONENT_SITE.'/helpers/acl.php';

JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');

$controller	= JControllerLegacy::getInstance('Confmgr');
$input = JFactory::getApplication()->input;

$lang = JFactory::getLanguage();
$lang->load('joomla', JPATH_ADMINISTRATOR);

// Get the document object.
$document	= JFactory::getDocument();
// Add a custom CSS for the frontend
$url = 'components/com_confmgr/assets/css/confmgr.css';
$document->addStyleSheet($url);

try 
{
	$controller->execute($input->get('task'));
} 
catch (Exception $e) 
{
	$controller->setRedirect(JURI::base(), $e->getMessage(), 'error');
}

$controller->redirect();
