<?php
/**
 * @version     2.5.8.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// no direct access
defined('_JEXEC') or die;
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::sprintf('COM_CONFMGT_VIEW_ENTRYPAGE_ENTRY_OPTIONS_PANEL_HEADING', $this->sitename); ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_VIEW_ENTRYPAGE_ENTRY_OPTIONS_PANEL_DETAILS'); ?></p>
    <div align="center">
      <div class="button-container">
        <div class="inline">
          <form id="form-enrty-1" action="<?php echo JRoute::_('index.php'); ?>" 
          method="post" enctype="multipart/form-data" class="form-inline form-entry">
            <?php echo JHtml::_('form.token'); ?>
            <button class="btn btn-entry btn-default" type="submit"> 
			<?php echo '<span class="centre"><img src="'.JURI::root().
			'components/com_confmgt/assets/img/Login-icon.png" alt="Login" 
			height="42" width="42"></span><br />';?> <?php echo JText::_("COM_CONFMGT_VIEW_ENTRYPAGE_ENTRY_OPTIONS_LOGIN"); ?> 
            </button>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="loginform" />
            <input type="hidden" name="layout" value="default" />
          </form>
        </div>
        <div class="inline">
          <form id="form-enrty-2" action="<?php echo JRoute::_('index.php'); ?>" 
          method="post" enctype="multipart/form-data"  class="form-inline form-entry">
            <?php echo JHtml::_('form.token'); ?>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="regform" />
            <input type="hidden" name="layout" value="leader_default" />
            <button class="btn btn-entry btn-default" type="submit"> 
			<?php echo '<span class="centre"><img src="'.JURI::root().
			'components/com_confmgt/assets/img/Register-icon.png" 
			alt="Create an account" height="42" width="42"></span><br />';?> 
			<?php echo JText::_("COM_CONFMGT_VIEW_ENTRYPAGE_ENTRY_OPTIONS_CREATE"); ?>
            </button>
          </form>
        </div>
      </div>
    </div>
    <div align="center">
      <p><a href="index.php?option=com_users&view=reset"><?php echo JText::_('Forgot your password?'); ?></a></p>
      <p><a href="index.php?option=com_users&view=remind"><?php echo JText::_('Forgot your username?'); ?></a></p>
    </div>
  </div>
</div>
