<?php

/**
 * @version		0.0.5
 * @package		com_confmgr
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

// no direct access
defined('_JEXEC') or die;
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
            <input type="hidden" name="option" value="com_confmgr" />
            <input type="hidden" name="view" value="papers" />
            <input type="hidden" name="layout" value="default" />
            <button class="btn btn-default btn-entry" type="submit"> 
			<span class="centre">
			<img src="components/com_confmgr/assets/img/author.png" alt="Author" 
			height="42" width="42">
			</span>
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
            <input type="hidden" name="option" value="com_confmgr" />
            <input type="hidden" name="view" value="papers" />
            <input type="hidden" name="layout" value="leader_default" />
            <button class="btn btn-default btn-entry" type="submit"> 
			<span class="centre">
			<img src="components/com_confmgr/assets/img/theme_leader.png" alt="Theme Leader" 
			height="42" width="42">
			</span>
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
            <input type="hidden" name="option" value="com_confmgr" />
            <input type="hidden" name="view" value="rev1ews" />
            <input type="hidden" name="layout" value="default" />
            <button class="btn btn-default btn-entry" type="submit"> 
			<span class="centre">
			<img src="components/com_confmgt/assets/img/reviewers.png" alt="Login" 
			height="42" width="42">
			</span>
			<?php echo JText::_("COM_CONFMGT_VIEW_ENTRYPAGE_DEFAULT_REVIEWER"); ?>
            </button>
          </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
