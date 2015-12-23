<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

/**
 * Papers list controller class.
 *
 * @package     Confmgr
 * @subpackage  Controllers
 */
class ConfmgrControllerPapers extends JControllerAdmin
{
	/**
	 * The URL view list variable.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $view_list = 'Papers';
	
	/**
	 * Get the admin model and set it to default
	 *
	 * @param   string           $name    Name of the model.
	 * @param   string           $prefix  Prefix of the model.
	 * @param   array			 $config  The model configuration.
	 */
	public function getModel($name = 'Paper', $prefix='ConfmgrModel', $config = array())
	{
		$config['ignore_request'] = true;
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
	public function newAbstract()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('Paper', 'ConfmgrModel');
		$authors = $this->getModel ('Authors_for_paper', 'ConfmgrModel');
	
		// create a new data array.
		$data = array();
	
		// Attempt to save the data and get the last saved record by the user
		$return	= $model->newAbstract($data);
	
		if ($return) 
		{
			//Check if there is an authors list; if not redierct to create one
			if (!$authors->getItems())
			{
				$app->enqueueMessage(JText::_('You need to create a list of authors for your abstracts first', 'warning'));
				$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=paper&layout=edit&id='.$return, false));
			}
			else
			{
				// redirect to the new abstract page
				$this->setRedirect(JRoute::_('index.php?option=com_confmgr&view=paper&layout=edit&id='.$return, false));
			}
		}
		else
		{
			// Redirect to the list screen.
			$this->setRedirect(JRoute::_('index.php?option=com_confmgt&view=papers', false));
		}
	
	}
}
?>