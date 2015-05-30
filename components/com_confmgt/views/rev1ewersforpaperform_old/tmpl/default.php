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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>

<div class = 'form-horizontal well'>
  <fieldset>
    <div class="rev_paper-edit front-end-edit">
      <?php if (!empty($this->item->id)): ?>
      <legend><?php echo JText::_('Edit Reviewers allocation'); ?></legend>
      <?php else: ?>
      <legend><?php echo JText::_('Allocate reviewers'); ?></legend>
      <?php endif; ?>
      <form id="form-rev_paper" role="form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
          <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('rev1ewer'); ?> </div>
          <div class="col-sm-10"> <?php echo $this->form->getInput('rev1ewer'); ?> </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('firstname'); ?> </div>
          <div class="col-sm-10"> <?php echo $this->form->getInput('firstname'); ?> </div>
        </div>
            <button type="submit" class="btn btn-primary" ><?php echo JText::_('JSUBMIT'); ?></button>
            <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=authorform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="rev1ewersforpaperform.save" />
            <?php echo JHtml::_('form.token'); ?>
      </form>
    </div>
  </fieldset>
</div>
