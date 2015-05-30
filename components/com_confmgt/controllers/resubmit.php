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
      <legend><?php echo JText::_('Abstract resubmit'); ?></legend>
      <form id="form-paper" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=paperform.save_resubmit'); ?> 
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
         <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('id'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('id'); ?> </div>
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
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo JText::_('JSUBMIT'); ?> </button>
            <?php echo JText::_('or'); ?> <a href="<?php echo jroute::_('index.php?option=com_confmgt&task=paperform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>
				"><?php echo JText::_('JCANCEL'); ?> </a>
            <input type="hidden" name="option" value="com_confmgt"/>
            <input type="hidden" name="jform['linkid']" value="<?php echo $this->linkid; ?>" />
            <input type="hidden" name="task" value="paperform.save_resubmit"/>
            <?php echo JHtml::_('form.token'); ?> </div>
        </div>
      </form>
    </div>
  </fieldset>
</div>
