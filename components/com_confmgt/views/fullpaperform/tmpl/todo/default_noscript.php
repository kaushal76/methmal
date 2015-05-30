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
?>

<div class = 'form-horizontal well'>
  <fieldset>
    <div class="reviewoutcome-edit front-end-edit">
      <legend><?php echo JText::_('Full paper upload'); ?></legend>
      <form id="form-paper" role="form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        <div class="control-group">
          <div class="control-label"> <?php echo $this->form->getLabel('full_paper'); ?> </div>
          <div class="controls"> <?php echo $this->form->getInput('full_paper'); ?> </div>
        </div>
        <div class="control-group">
          <div class="form-actions modal-footer">
            <input type="submit" class="btn btn-primary" name = "submit" value = "<?php echo JText::_('Upload'); ?>" />
            <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=fullpaperform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="linkid" value="<?php echo $this->linkid; ?>" />
            <input type="hidden" name="task" value="fullpaperform.save" />
            <?php echo JHtml::_('form.token'); ?></div>
        </div>
      </form>
    </div>
  </fieldset>
</div>
