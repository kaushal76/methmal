<?php
/**
 * @author		Dr Kaushal Keraminiyage
* @copyright	Dr Kaushal Keraminiyage
* @license		GNU General Public License version 2 or later
*/

defined("_JEXEC") or die("Restricted access");

/**
 * Entry page table class.
 *
 * @package     Confmgr
 * @subpackage  Tables
*/
class ConfmgrTableEntrypage extends JTable
{

	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__confmgr_paper', 'id', $db);
	}
	

}
?>