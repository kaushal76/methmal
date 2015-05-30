<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
//no direct access 
 defined('_JEXEC') or die; 
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');


 //Load admin language file 
 $lang = JFactory::getLanguage(); 
 $lang->load('com_confmgt', JPATH_ADMINISTRATOR); ?>

<div class = 'form-horizontal well'>
  <fieldset>
    <div class="paper-edit front-end-edit">
      <?php if (!empty($this->item->id)): ?>
      <legend><?php echo JText::_('Step 2 of 2: Paper ID: '); echo $this->item->id; ?></legend>
      <?php else: ?>
      <legend><?php echo JText::_('Subimit a new abstract'); ?></legend>
      <?php endif; ?>
      <form id="form-paper" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=paperform.save'); ?> 
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('id'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('id'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('abstractid'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('abstractid'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('title'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('title'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('abstract'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('abstract'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('keywords'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('keywords'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('theme'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('theme'); ?> </div>
        </div>
         <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('student_submission'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('student_submission'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('created_by'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('created_by'); ?> </div>
        </div>
        <div class="control-group">
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo JText::_('JSUBMIT'); ?> </button>
            <?php echo JText::_('or'); ?> <a href="<?php echo jroute::_('index.php?option=com_confmgt&task=paperform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>
				"><?php echo JText::_('JCANCEL'); ?> </a>
            <input type="hidden" name="option" value="com_confmgt"/>
            <input type="hidden" name="linkid" value="<?php echo $this->linkid; ?>" />
            <input type="hidden" name="task" value="paperform.save"/>
            <?php echo JHtml::_('form.token'); ?> </div>
        </div>
      </form>
    </div>
  </fieldset>
</div>
