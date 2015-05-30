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
JHtml::_('behavior.modal');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>

<div class="presentation-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1> 
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>
 
    <form id="form-presentation" role = "form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=presentationform.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
		<div class="form-group">
        <div class="col-sm-2 control-label">
		<?php echo $this->form->getLabel('type'); ?>
        </div>
        <div class="col-sm-10">
		<?php echo $this->form->getInput('type'); ?> 
        </div>
        </div>
           
        <div class="form-group">     
        <div class="col-sm-2 control-label">
		<?php echo $this->form->getLabel('presentation'); ?>
        </div>
        <div class="col-sm-10">
		<?php echo $this->form->getInput('presentation'); ?>
        </div> 
        </div>   

        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name = "submit" value = "<?php echo JText::_('JSUBMIT'); ?>" />
            <?php echo JText::_('or'); ?>
            <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=presentationform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="linkid" value="<?php echo $this->linkid; ?>" />
            <input type="hidden" name="task" value="presentationform.save" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
        </div>
    </form>
</div>

