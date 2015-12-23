<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

//no direct access 
 defined('_JEXEC') or die; 
?>

<div id="regmodal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="regModalLabel"><?php echo JText::_('Create an Account'); ?></h2>
			</div>
			<div class="form-horizontal well">
				<fieldset>
					<div class="reg-edit front-end-edit">
						<form id="form-reg" role="form"
							action="<?php echo JRoute::_('index.php?option=com_confmgr&task=regform.save'); ?>
		"
							method="post" class="form-validate" enctype="multipart/form-data">

							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('id'); ?> </div>
							</div>
							<div class="control-group ">
								<div class="control-label">
	                  <?php echo $this->form->getLabel('title'); ?>
	                  </div>
								<div class="controls"> <?php
								
echo $this->form->getInput ( 'title' );
								?> 
					  </div>
							</div>
							<div class="control-group ">
								<div class="control-label">
	                  <?php echo $this->form->getLabel('firstname'); ?>
	                  </div>
								<div class="controls"> <?php
								
echo $this->form->getInput ( 'firstname' );
								?> 
					  </div>
							</div>
							<div class="control-group ">
								<div class="control-label">
	                  <?php echo $this->form->getLabel('surname'); ?>
	                  </div>
								<div class="controls"> <?php
								
echo $this->form->getInput ( 'surname' );
								?> 
					  </div>
							</div>
							<div class="control-group">
								<div class="control-label"> <?php
								
echo $this->form->getLabel ( 'email' );
								?> </div>
								<div class="controls"> <?php
								
echo $this->form->getInput ( 'email' );
								?> </div>
							</div>
							<div class="control-group">
								<div class="control-label"> <?php
								
echo $this->form->getLabel ( 'username' );
								?> </div>
								<div class="controls"> <?php
								
echo $this->form->getInput ( 'username' );
								?> </div>
							</div>
							<div class="control-group">
								<div class="control-label"> <?php
								
echo $this->form->getLabel ( 'password' );
								?> </div>
								<div class="controls"> <?php
								
echo $this->form->getInput ( 'password' );
								?> </div>
							</div>
							<div class="control-group">
								<div class="control-label"> <?php
								
echo $this->form->getLabel ( 'password2' );
								?> </div>
								<div class="controls"> <?php
								
echo $this->form->getInput ( 'password2' );
								?> </div>
							</div>
							<div class="control-group">
								<div class="form-actions modal-footer">
									<button type="submit" class="btn btn-primary"><?php echo JText::_('JSUBMIT'); ?> </button>
                      <?php echo JText::_('or'); ?> <a
										href="<?php echo jroute::_('index.php?option=com_confmgr&task=regform.cancel'); ?>"
										title="<?php echo JText::_('JCANCEL'); ?>
				"><?php echo JText::_('JCANCEL'); ?> </a> <input type="hidden"
										name="option" value="com_confmgr" /> <input type="hidden"
										name="task" value="regform.save" />
                      <?php echo JHtml::_('form.token'); ?> </div>
							</div>
						</form>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
</div>


