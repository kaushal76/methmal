<?php
/**
 * @version     2.5.8
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
defined ( '_JEXEC' ) or die ();

// Include dependancies
jimport ( 'joomla.application.component.controller' );

// adding helpers
JLoader::register ( 'ConfmgtHelper', JPATH_COMPONENT . '/helpers/confmgt.php' );
JLoader::register ( 'AclHelper', JPATH_COMPONENT . '/helpers/acl.php' );
JLoader::register ( 'EmailHelper', JPATH_COMPONENT . '/helpers/email.php' );
JLoader::register ( 'UploadHelper', JPATH_COMPONENT . '/helpers/upload.php' );

// adding overiding styles
$url = "components/com_confmgt/assets/css/confmgt.css";
$document = JFactory::getDocument ();
$document->addStyleSheet ( $url );
?>

<?php
// Execute the task.
$controller = JController::getInstance ( 'Confmgt' );
$controller->registerDefaultTask ( 'displayDefault' );
$controller->execute ( JFactory::getApplication ()->input->get ( 'task' ) );
$controller->redirect (); 
