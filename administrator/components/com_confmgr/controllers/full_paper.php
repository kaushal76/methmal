<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Full_paper item controller class.
 *
 * @package     Confmgr
 * @subpackage  Controllers
 */
class ConfmgrControllerFull_paper extends JControllerForm
{
	/**
	 * The URL view item variable.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $view_item = 'Full_paper';

	/**
	 * The URL view list variable.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $view_list = 'Full_papers';
	
	/**
	 * Method to run batch operations.
	 *
	 * @param   object  $model  The model.
	 *
	 * @return  boolean   True if successful, false otherwise and internal error is set.
	 *
	 * @since   2.5
	 */
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Set the model
		$model = $this->getModel('Full_paper', 'ConfmgrModel', array());

		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=full_papers' . $this->getRedirectToListAppend(), false));

		return parent::batch($model);
	}
}
?>