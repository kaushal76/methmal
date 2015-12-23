<?php
/**
 * @version		0.0.5
 * @package		com_confmgr
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */
 //no direct access 
 defined('_JEXEC') or die; 
?>

<div class="modal fade" id="loginmodal" tabindex = "-1" role="button" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="loginModalLabel"><?php echo JText::_('LOGIN'); ?></h2>
      </div>
      <div class="modal-body">
        <div class = "form-horizontal well">
          <fieldset>
            <div class="reg-edit front-end-edit">
              <form id="form-loginmodal-1" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgr&task=entrypage.login'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
                <div class="control-group">
                  <div class="control-label"> <?php echo $this->loginform->getLabel('username'); ?> </div>
                  <div class="controls"> <?php echo $this->loginform->getInput('username'); ?> </div>
                </div>
                <div class="control-group">
                  <div class="control-label"> <?php echo $this->loginform->getLabel('pw'); ?> </div>
                  <div class="controls"> <?php echo $this->loginform->getInput('pw'); ?> </div>
                </div>
                <div class="control-group">
                  <div class="form-actions modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo JText::_('LOGIN'); ?> </button>
                    <?php echo JText::_('or'); ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgr&task=entrypage.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?> 
				"><?php echo JText::_('JCANCEL'); ?> </a>
                    <input type="hidden" name="option" value="com_confmgr"/>
                    <input type="hidden" name="task" value="entrypage.login"/> 
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