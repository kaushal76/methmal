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
JHtml::_('bootstrap.modal');
JHtml::_('bootstrap.alert', 'error');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>
 <div class = 'form-horizontal well'>
    <fieldset>
		<div class="camerareadypaper-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1> 
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>
 
    <form id="form-camerareadypaper" role = "form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=camerareadypaperform.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
		<div class="control-group">
        <div class="control-label">
		<?php echo $this->form->getLabel('type'); ?>
        </div>
        <div class="controls">
		<?php echo $this->form->getInput('type'); ?> 
        </div>
        </div>
           
        <div class="control-group">     
        <div class="control-label">
		<?php echo $this->form->getLabel('camera_ready'); ?>
        </div>
        <div class="controls">
		<?php echo $this->form->getInput('camera_ready'); ?>
        </div> 
        </div>   

        <div class="control-group">
        <div class="form-actions">
            <input type="submit" class="btn btn-primary" name = "submit" value = "<?php echo JText::_('JSUBMIT'); ?>" />
            <?php echo JText::_('or'); ?>
            <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=camerareadypaperform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="linkid" value="<?php echo $this->linkid; ?>" />
            <input type="hidden" name="task" value="camerareadypaperform.save" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
        </div>
    </form>
</div>
</fieldset>
</div>

