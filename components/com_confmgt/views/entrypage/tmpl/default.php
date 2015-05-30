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

JHtml::_('behavior.modal');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::sprintf('COM_CONFMGT_VIEW_ENTRYPAGE_DEFAULT_PANEL_HEADING', $this->sitename); ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_VIEW_ENTRYPAGE_DEFAULT_PANEL_DETAILS'); ?></p>
    <div align="center">
      <div class="button-container">
        <div class="inline">
          <?php if ($this->role['isAuthor']) : ?>
          <form id="form-enrty-1" action="<?php echo JRoute::_('index.php'); ?>" 
          method="post" enctype="multipart/form-data" class="form-entry">
            <?php echo JHtml::_('form.token'); ?>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="papers" />
            <input type="hidden" name="layout" value="default" />
            <button class="btn btn-default btn-entry" type="submit"> 
			<?php echo '<span class="centre"><img src="'.JURI::root().
			'components/com_confmgt/assets/img/author.png" alt="Login" 
			height="42" width="42"></span><br />';?> 
			<?php echo JText::_("COM_CONFMGT_VIEW_ENTRYPAGE_DEFAULT_AUTHOR"); ?> 
            </button>
          </form>
          <?php endif; ?>
        </div>
        <div class="inline">
          <?php if ($this->role['isThemeleader']) : ?>
          <form id="form-enrty-2" action="<?php echo JRoute::_('index.php'); ?>" 
          method="post" enctype="multipart/form-data"  class="form-entry">
            <?php echo JHtml::_('form.token'); ?>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="papers" />
            <input type="hidden" name="layout" value="leader_default" />
            <button class="btn btn-default btn-entry" type="submit"> 
			<?php echo '<span class="centre"><img src="'.JURI::root().
			'components/com_confmgt/assets/img/theme_leader.png" alt="Login" 
			height="42" width="42"></span><br />';?> 
			<?php echo JText::_("COM_CONFMGT_VIEW_ENTRYPAGE_DEFAULT_THEME_LEADER"); ?> 
            </button>
          </form>
          <?php endif; ?>
        </div>
        <div class="inline">
          <?php if ($this->role['isRev1ewer']) : ?>
          <form id="form-enrty-3" action="<?php echo JRoute::_('index.php'); ?>" 
          method="post" enctype="multipart/form-data" class="form-entry">
            <?php echo JHtml::_('form.token'); ?>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="rev1ews" />
            <input type="hidden" name="layout" value="default" />
            <button class="btn btn-default btn-entry" type="submit"> 
			<?php echo '<span class="centre"><img src="'.JURI::root().
			'components/com_confmgt/assets/img/reviewers.png" alt="Login" 
			height="42" width="42"></span><br />';?> 
			<?php echo JText::_("COM_CONFMGT_VIEW_ENTRYPAGE_DEFAULT_REVIEWER"); ?>
            </button>
          </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
