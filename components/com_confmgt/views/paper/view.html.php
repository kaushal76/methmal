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

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class ConfmgtViewPaper extends JView {

    protected $state;
    protected $item;
    protected $form;
    protected $params;
	protected $linkid;
	protected $authors;
	protected $fullpapers;
	protected $camerareadypapers;
	protected $presentations;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        
		$app	= JFactory::getApplication();
        $user	= JFactory::getUser();
		
		//getting the authors and full papers linked with the item
			
		$this->authors = $this->get('Items', 'Authors');
		$this->fullpapers = $this->get('Items', 'Fullpapers');
		$this->camerareadypapers = $this->get('Items', 'Camerareadypapers');
		$this->presentations = $this->get('Items', 'Presentations');
		
		$this->form		= $this->get('Form');
		$this->linkid	= $this->get('Linkid');
	        
        $this->state = $this->get('State');
        $this->item = $this->get('Data');

        $this->params = $app->getParams('com_confmgt');
		$this->isAuthor = AclHelper::isAuthor($this->item->id);


        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }      
        
        if($this->_layout == 'edit') {
		// only registerd can create an abstract
		
			if ($this->item->id > 0) {				
				$authorised  = AclHelper::isAuthor($this->item->id);				
			}else{			
			$authorised = ($user->id > 0);			
			}
			if ($authorised !== true) {
            throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
        	}
        }
		// If the user is requesting a theme leader view, then he must be a theme leader
		if($this->_layout == 'leader_default') {
			$authorised  = AclHelper::isThemeleader();
			
			if ($authorised !== true) {
            throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
        	}
		}
		        
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
		$document = &JFactory::getDocument(); 

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
		$document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$document->setMetadata('robots', $this->params->get('robots'));
		}
	}        
    
}
