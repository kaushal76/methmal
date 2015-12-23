<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");
 
/**
 * Abstract item view class.
 *
 * @package     Confmgr
 * @subpackage  Views
 */
class ConfmgrViewRegForm extends JViewLegacy
{	
	protected $form;
	
	public function display($tpl = null)
	{

		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();
		$config = JFactory::getConfig();
		
		//Get the form
		$this->form = $this->get('Form');
			
		parent::display($tpl);
	}
}
