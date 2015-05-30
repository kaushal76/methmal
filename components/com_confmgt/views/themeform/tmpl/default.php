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
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>

<div class = 'form-horizontal well'>
  <fieldset>
    <div class="author-edit front-end-edit">
      <?php if (!empty($this->item->id)): ?>
      <legend><?php echo JText::_('Edit Theme Details'); ?></legend>
      <?php else: ?>
      <legend><?php echo JText::_('Add New Theme'); ?></legend>
      <?php endif; ?>
      <form id="form-theme" role="form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        <div class="control-group">
          <div class="control-label"> <?php echo $this->form->getLabel('id'); ?> </div>
          <div class="controls"> <?php echo $this->form->getInput('id'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->form->getLabel('title'); ?> </div>
          <div class="controls"> <?php echo $this->form->getInput('title'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->form->getLabel('description'); ?> </div>
          <div class="controls"> <?php echo $this->form->getInput('description'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->form->getLabel('userid'); ?> </div>
          <div class="controls"> <?php echo $this->form->getInput('userid'); ?> </div>
        </div>
        <div class="control-group">
          <div class="form-actions">
            <button type="submit" class="btn btn-primary" ><?php echo JText::_('JSUBMIT'); ?></button>
            <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=themeform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="themeform.save" />
            <?php echo JHtml::_('form.token'); ?> </div>
        </div>
      </form>
    </div>
  </fieldset>
</div>
