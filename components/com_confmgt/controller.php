<?php
/**
 * @version     2.5.8
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
 
// No direct access

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class ConfmgtController extends JController
{
	public function displayDefault() {
		$user=JFactory::getuser();
		
		//No views set, hence setting the entrypage as the default view.
		if (JFactory::getApplication()->input->get('view')==''){
		JFactory::getApplication()->input->set('view', 'entrypage');
		}
		
		if ($user->guest) {
			//guest users can see  the login page
			if (JFactory::getApplication()->input->get('view')=='loginform') {
				$this->setMessage(JText::_('COM_CONFMGT_LOGIN_REQUIRED', 'information'));
			//they can also see the registration form
			}elseif (JFactory::getApplication()->input->get('view')=='regform') {			
				$this->setMessage(JText::_('COM_CONFMGT_REG_REQUIRED', 'information'));
			//they may be a reviewer confirming their agreement to review
			}elseif ((JFactory::getApplication()->input->get('view')=='rev1ewerform')
					&&(JFactory::getApplication()->input->get('layout')=='agree_form')) {			
			//anyone else should be directed to the entry page
			}else{
				$this->setMessage(JText::_('COM_CONFMGT_GUEST_NEW', 'information'));
				JFactory::getApplication()->input->set('view', 'entrypage');
				JFactory::getApplication()->input->set('layout', 'entry');
			}
		}
		
		//set models for the paper view (data from 3 models)
		if (JFactory::getApplication()->input->get('view')=='paper'){
		$view = $this->getView( 'Paper', 'html' );
		$view->setModel( $this->getModel( 'Paper' ), true );
		$view->setModel( $this->getModel( 'Authors' ) );
		$view->setModel( $this->getModel( 'Fullpapers' ) );
		$view->setModel( $this->getModel( 'Camerareadypapers' ) );
		$view->setModel( $this->getModel( 'Presentations' ) );
		$view->display();
		
		}else{
		
		//for all other views set the display
			$this->display();
		}
	}

}

