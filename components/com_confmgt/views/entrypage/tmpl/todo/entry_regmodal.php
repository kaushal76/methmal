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
 
?>

  <div class="modal fade" id="regmodal" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="regModalLabel"><?php echo JText::_('Create an Account'); ?></h4>
        </div>
        <div class="modal-body">
          <div class = "form-horizontal well">
            <fieldset>
              <div class="reg-edit front-end-edit">
                <form id="form-reg" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=regform.save'); ?>
		" method="post" class="form-validate" enctype="multipart/form-data">
                  
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->regform->getLabel('id'); ?> </div>
                    <div class="controls"> <?php echo $this->regform->getInput('id'); ?> </div>
                  </div>
                  <div class="form-group form-horizontal ">
                  <div class="control-label"> <label id="jform_name-lbl" for="jform_surname" class="hasTip required" title="Name::Please enter your name"><?php echo JText::_('Name'); ?><span class="star">&#160;*</span></label> </div>
                  <div class="controls  form-inline">
                  <?php echo $this->regform->getInput('title'); ?> 
                  <?php echo $this->regform->getInput('firstname'); ?>
                  <?php echo $this->regform->getInput('surname'); ?>
                  </div>
                  </div>
                  <div class="form-group form-horizontal ">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('email'); ?> </div>
                    <div class="controls"> <?php echo $this->
				regform->getInput('email'); ?> </div>
                  </div>
                  <div class="form-group  form-horizontal ">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('username'); ?> </div>
                    <div class="controls"> <?php echo $this->
				regform->getInput('username'); ?> </div>
                  </div>
                  <div class="form-group form-horizontal ">
                    <div class="control-label"> <?php echo $this-> 
				regform->getLabel('password'); ?> </div>
                    <div class="controls"> <?php echo $this->
				regform->getInput('password'); ?> </div>
                  </div>
                  <div class="form-group form-horizontal ">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('password2'); ?> </div>
                    <div class="controls"> <?php echo $this->
				regform->getInput('password2'); ?> </div>
                  </div>
                  <div class="form-group form-horizontal ">
                    <div class="form-actions modal-footer">
                      <button type="submit" class="btn btn-primary"><?php echo JText::_('JSUBMIT'); ?> </button>
                      <?php echo JText::_('or'); ?> <a href="<?php echo jroute::_('index.php?option=com_confmgt&task=regform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>
				"><?php echo JText::_('JCANCEL'); ?> </a>
                      <input type="hidden" name="option" value="com_confmgt"/>
                      <input type="hidden" name="task" value="regform.save"/>
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
