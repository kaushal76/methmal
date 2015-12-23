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
class ConfmgrViewEntrypage extends JViewLegacy
{	
	protected $form;
	
	public function display($tpl = null)
	{

		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();
		$config = JFactory::getConfig();
		
		//Get the login form
		$this->loginform = $this->get('LoginForm');
		
		// check the user's role and define role as an array; 
		$this->role = array();	
		
		// if the user is logged in by default the user is an author
		$this->role['isAuthor'] = AclHelper::isAuthor();
		
		// if the user is assigned as a themeleader in the backend, 
		// he is to be authenticated as a theme leader
		$this->role['isThemeleader'] = AclHelper::isThemeleader();
		
		// if the user has been invited (and agreed) to be a reviwer, 
		// he needs to be autheticate as a reviewer
		$this->role['isRev1ewer'] = AclHelper::isRev1ewer();
			
		// get the sitename to make a part of the heading
		$this->sitename = $config->get( 'sitename' );
		
		parent::display($tpl);
	}
}
