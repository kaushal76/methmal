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

jimport('joomla.application.component.view');

/**
 * View to edit
 */

class ConfmgtViewEntrypage extends JView {

    protected $role;
    protected $sitename;
    protected $params;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        
		$app	= JFactory::getApplication();
        $user	= JFactory::getUser();
		$config =& JFactory::getConfig();
		
        $this->state = $this->get('State');
        $this->item = $this->get('Data');
        $this->params = $app->getParams('com_confmgt');	
		$this->form	= $this->get('Form');
		$this->regform = $this->get('RegForm');
		
		// check the user's role and define role as an array; 
		$this->role = array();	
		
		// if the user is logged in by default the user is an author
		$this->role['isAuthor'] = ($user->id > 0);
		
		// if the user is assigned as a themeleader in the backend, 
		// he is to be authenticated as a theme leader
		$this->role['isThemeleader'] = AclHelper::isThemeleader();
		
		// if the user has been invited (and agreed) to be a reviwer, 
		// he needs to be autheticate as a reviewer
		$this->role['isRev1ewer'] = AclHelper::isRev1ewer();
			
		// get the sitename to make a part of the heading
		$this->sitename = $config->getValue( 'config.sitename' );
       
	    // prepare the document properties 
        $this->_prepareDocument();

        parent::display($tpl);
    }

	/**
	 * Prepares the document
	 */

	protected function _prepareDocument()
	{
		$app	= JFactory::getApplication(); 
		$menus	= $app->getMenu();
		$title	= null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		
		$menu = $menus->getActive();
		if($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', JText::_('COM_CONFMGT_DEFAULT_PAGE_TITLE'));
		}
		
		$title = $this->params->get('page_title', '');
		
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}        
    
}
