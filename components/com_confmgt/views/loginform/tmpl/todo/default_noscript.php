<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
 */ 
 
 //no direct access 
 defined('_JEXEC') or die; 
 JHtml::_('behavior.keepalive'); 
 JHtml::_('behavior.tooltip'); 
 JHtml::_('behavior.formvalidation');  
 
?>

<div id="nonscripted">
  <div class = 'form-horizontal well'>
    <fieldset>
      <div class="reg-edit front-end-edit">
        <legend><?php echo JText::_('LOGIN'); ?></legend>
        <form id="form-reg" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=loginform.login'); ?>
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-sm-2 control-label"> <?php echo $this->form->getLabel('username'); ?> </div>
            <div class="col-sm-10"> <?php echo $this->form->getInput('username'); ?> </div>
          </div>
          <div class="form-group">
            <div class="col-sm-2 control-label"> <?php echo $this->
				form->getLabel('pw'); ?> </div>
            <div class="col-sm-10"> <?php echo $this->
				form->getInput('pw'); ?> </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
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
