<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

require_once JPATH_COMPONENT.'/helpers/confmgr.php';

/**
 * Authors_for_paper list view class.
 *
 * @package     Confmgr
 * @subpackage  Views
 */
class ConfmgrViewAuthors_for_paper extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;
	
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->state = $this->get('State');
		$this->pagination = $this->get('Pagination');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
			return false;
		}
		
		ConfmgrHelper::addSubmenu('authors_for_paper');
		
		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
		}
		
		parent::display($tpl);
	}
	
	/**
	 *	Method to add a toolbar
	 */
	protected function addToolbar()
	{
		$state	= $this->get('State');
		$canDo	= ConfmgrHelper::getActions();
		$user	= JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		
		JToolBarHelper::title(JText::_('COM_CONFMGR_AUTHOR_FOR_PAPER_VIEW_AUTHORS_FOR_PAPER_TITLE'));
		
		if ($canDo->get('core.create'))
		{
			JToolBarHelper::addNew('author_for_paper.add','JTOOLBAR_NEW');
		}

		if (($canDo->get('core.edit')) && isset($this->items[0]))
		{
			JToolBarHelper::editList('author_for_paper.edit','JTOOLBAR_EDIT');
		}
		
		if ($canDo->get('core.edit.state'))
		{
            if (isset($this->items[0]->published))
			{
			    JToolBarHelper::divider();
				JToolbarHelper::publish('authors_for_paper.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('authors_for_paper.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            } 
			else if (isset($this->items[0]))
			{
                // Show a direct delete button
                JToolBarHelper::deleteList('', 'authors_for_paper.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->published))
			{
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('authors_for_paper.archive','JTOOLBAR_ARCHIVE');
            }
            
			if (isset($this->items[0]->checked_out))
			{
				JToolbarHelper::checkin('authors_for_paper.checkin');
            }
		}
		
		// Show trash and delete for components that uses the state field
        if (isset($this->items[0]->published))
		{
		    if ($state->get('filter.published') == -2 && $canDo->get('core.delete'))
			{
			    JToolBarHelper::deleteList('', 'authors_for_paper.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    }
			else if ($state->get('filter.published') != -2 && $canDo->get('core.edit.state'))
			{
			    JToolBarHelper::trash('authors_for_paper.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }
		
		// Add a batch button
		if (isset($this->items[0]) && $user->authorise('core.create', 'com_contacts') && $user->authorise('core.edit', 'com_contacts') && $user->authorise('core.edit.state', 'com_contacts'))
		{
			JHtml::_('bootstrap.modal', 'collapseModal');
			$title = JText::_('JTOOLBAR_BATCH');

			// Instantiate a new JLayoutFile instance and render the batch button
			$layout = new JLayoutFile('joomla.toolbar.batch');

			$dhtml = $layout->render(array('title' => $title));
			$bar->appendButton('Custom', $dhtml, 'batch');
		}
		
		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_confmgr');
		}
	}
}
?>