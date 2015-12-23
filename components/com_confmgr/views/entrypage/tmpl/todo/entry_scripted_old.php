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

<div id="scripted">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h1><?php echo JText::sprintf('COM_CONFMGT_ENTRY_FORM_PANEL_HEADING', $this->sitename); ?></h1>
    </div>
    <div class="panel-body">
      <p><?php echo JText::_('COM_CONFMGT_ENRTY_LAYOUT_PANEL_DETAILS'); ?></p>
      <div align="center"> <span>
        <button data-toggle="modal" class="btn btn-large btn-default" type="button" data-target="#loginmodal"><?php echo JText::_("Login"); ?> </button>
        </span> <span>
        <button class="btn btn-large btn-default" type="button" data-target="#regmodal" data-toggle="modal"><?php echo JText::_("Create an account"); ?> </button>
        </span> </div>
    </div>
  </div>
  <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="loginModalLabel"><?php echo JText::_('LOGIN'); ?></h4>
        </div>
        <div class="modal-body">
          <div class = 'form-horizontal well'>
            <fieldset>
              <div class="reg-edit front-end-edit">
                <legend><?php echo JText::_('LOGIN'); ?></legend>
                <form id="form-reg" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=loginform.login'); ?>
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->form->getLabel('username'); ?> </div>
                    <div class="control"> <?php echo $this->form->getInput('username'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				form->getLabel('pw'); ?> </div>
                    <div class="control"> <?php echo $this->
				form->getInput('pw'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="form-actions modal-footer">
                      <button type="submit" class="btn btn-primary"><?php echo JText::_('LOGIN'); ?> </button>
                      <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=regform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?> 
				"><?php echo JText::_('JCANCEL'); ?> </a>
                      <input type="hidden" name="option" value="com_confmgt"/>
                      <input type="hidden" name="task" value="loginform.login"/>
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
  <div class="modal fade" id="regmodal" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="regModalLabel"><?php echo JText::_('Create an Account'); ?></h4>
        </div>
        <div class="modal-body">
          <div class = 'form-horizontal well'>
            <fieldset>
              <div class="reg-edit front-end-edit">
                <legend><?php echo JText::_('Creating a new account'); ?></legend>
                <form id="form-reg" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=regform.save'); ?>
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->regform->getLabel('id'); ?> </div>
                    <div class="control"> <?php echo $this->regform->getInput('id'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('title'); ?> </div>
                    <div class="control"> <?php echo $this->
				regform->getInput('title'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('firstname'); ?> </div>
                    <div class="control"> <?php echo $this->
				regform->getInput('firstname'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('surname'); ?> </div>
                    <div class="control"> <?php echo $this->
				regform->getInput('surname'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('email'); ?> </div>
                    <div class="control"> <?php echo $this->
				regform->getInput('email'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('username'); ?> </div>
                    <div class="control"> <?php echo $this->
				regform->getInput('username'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('password'); ?> </div>
                    <div class="control"> <?php echo $this->
				regform->getInput('password'); ?> </div>
                  </div>
                  <div class="form-group">
                    <div class="control-label"> <?php echo $this->
				regform->getLabel('password2'); ?> </div>
                    <div class="control"> <?php echo $this->
				regform->getInput('password2'); ?> </div>
                  </div>
                  <div class="form-group">
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
</div>
