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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class = 'form-horizontal well'>
          <fieldset>
            <div class="reviewoutcome-edit front-end-edit">
              <?php if (!empty($this->item->id)): ?>
              <legend><?php echo JText::_('Post review results to the author'); ?></legend>
              <?php else: ?>
              <legend><?php echo JText::_('Post review results to the author'); ?></legend>
              <?php endif; ?>
              <form id="form-paper" role="form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
                <div class="control-group">
                  <div class="control-label"> <?php echo $this->form->getLabel('id'); ?> </div>
                  <div class="controls"> <?php echo $this->form->getInput('id'); ?> </div>
                </div>
                <div class="control-group">
                  <div class="control-label"> <?php echo $this->form->getLabel('abstract_review_outcome'); ?> </div>
                  <div class="controls"> <?php echo $this->form->getInput('abstract_review_outcome'); ?> </div>
                </div>
                <div class="control-group">
                  <div class="control-label"> <?php echo $this->form->getLabel('abstract_review_comments'); ?> </div>
                  <div class="controls"> <?php echo $this->form->getInput('abstract_review_comments'); ?> </div>
                </div>
                <div class="control-group">
                  <div class="control-label"> <?php echo $this->form->getLabel('created_by'); ?> </div>
                  <div class="controls"> <?php echo $this->form->getInput('created_by'); ?> </div>
                </div>
                <div class="control-group">
                  <div class="form-actions modal-footer">
                    <button type="submit" class="btn btn-primary" ><?php echo JText::_('JSUBMIT'); ?></button>
                    <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=abrev1ewoutcomeform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
                    <input type="hidden" name="option" value="com_confmgt" />
                    <input type="hidden" name="jform[linkid]" value="<?php echo $this->linkid; ?>" />
                    <input type="hidden" name="jform[mode]" value="abstract" />
                    <input type="hidden" name="task" value="abrev1ewoutcomeform.save" />
                    <?php echo JHtml::_('form.token'); ?> </div>
                </div>
              </form>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
  </div>
</div>
