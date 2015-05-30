<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>

<div id="nonscripted">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h1><?php echo JText::sprintf('COM_CONFMGT_ENTRY_FORM_PANEL_HEADING', $this->sitename); ?></h1>
    </div>
    <div class="panel-body">
      <p><?php echo JText::_('COM_CONFMGT_ENRTY_LAYOUT_PANEL_DETAILS'); ?></p>
      <div align="center"> <span>
        <form id="form-enrty-1" action="<?php echo JRoute::_('index.php'); ?>" method="post" enctype="multipart/form-data" class="form-inline form-entry">
          <?php echo JHtml::_('form.token'); ?>
          <button class="btn btn-large btn-default" type="submit"><?php echo JText::_("Login"); ?> </button>
          <input type="hidden" name="option" value="com_confmgt" />
          <input type="hidden" name="view" value="loginform" />
          <input type="hidden" name="layout" value="default" />
        </form>
        </span> <span>
        <form id="form-enrty-2" action="<?php echo JRoute::_('index.php'); ?>" method="post" enctype="multipart/form-data"  class="form-inline form-entry">
          <?php echo JHtml::_('form.token'); ?>
          <input type="hidden" name="option" value="com_confmgt" />
          <input type="hidden" name="view" value="regform" />
          <input type="hidden" name="layout" value="leader_default" />
          <button class="btn btn-large btn-default" type="submit"><?php echo JText::_("Create an account"); ?> </button>
        </form>
        </span> </div>
    </div>
  </div>
</div>
