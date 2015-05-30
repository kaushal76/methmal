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

jimport('joomla.application.component.controllerform');

/**
 * Rev1ewer controller class.
 */
class ConfmgtControllerRev1ewer extends JControllerForm
{

    function __construct() {
        $this->view_list = 'rev1ewers';
        parent::__construct();
    }

}