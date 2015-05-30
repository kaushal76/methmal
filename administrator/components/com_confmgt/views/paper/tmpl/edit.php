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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_confmgt/assets/css/confmgt.css');
?>
<script type="text/javascript">
    function getScript(url,success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
        done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                || this.readyState == 'loaded'
                || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',function() {
        js = jQuery.noConflict();
        js(document).ready(function(){
            
					js('input:hidden.full_review_outcome').each(function(){
						var name = js(this).attr('name');
						if(name.indexOf('full_review_outcomehidden')){
							js('#jform_full_review_outcome option[value="'+jQuery(this).val()+'"]').attr('selected',true);
						}
					});
					js('input:hidden.abstract_review_outcome').each(function(){
						var name = js(this).attr('name');
						if(name.indexOf('abstract_review_outcomehidden')){
							js('#jform_abstract_review_outcome option[value="'+jQuery(this).val()+'"]').attr('selected',true);
						}
					});

            Joomla.submitbutton = function(task)
            {
                if (task == 'paper.cancel') {
                    Joomla.submitform(task, document.getElementById('paper-form'));
                }
                else{
                    
				js = jQuery.noConflict();
				if(js('#jform_full_paper').val() != ''){
					js('#jform_full_paper_hidden').val(js('#jform_full_paper').val());
				}
				js = jQuery.noConflict();
				if(js('#jform_camera_ready').val() != ''){
					js('#jform_camera_ready_hidden').val(js('#jform_camera_ready').val());
				}
				js = jQuery.noConflict();
				if(js('#jform_presentation').val() != ''){
					js('#jform_presentation_hidden').val(js('#jform_presentation').val());
				}
                    if (task != 'paper.cancel' && document.formvalidator.isValid(document.id('paper-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('paper-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }
        });
    });
</script>

<form action="<?php echo JRoute::_('index.php?option=com_confmgt&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="paper-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_CONFMGT_LEGEND_PAPER'); ?></legend>
            <ul class="adminformlist">

                				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>
				<li><?php echo $this->form->getLabel('abstract'); ?>
				<?php echo $this->form->getInput('abstract'); ?></li>
				<li><?php echo $this->form->getLabel('keywords'); ?>
				<?php echo $this->form->getInput('keywords'); ?></li>
				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>
				<li><?php echo $this->form->getLabel('created_by'); ?>
				<?php echo $this->form->getInput('created_by'); ?></li>
				<li><?php echo $this->form->getLabel('full_paper'); ?>
				<?php echo $this->form->getInput('full_paper'); ?></li>

				<?php if (!empty($this->item->full_paper)) : ?>
						<a href="<?php echo JRoute::_(JUri::base() . 'components' . DIRECTORY_SEPARATOR . 'com_confmgt' . DIRECTORY_SEPARATOR . 'upload' .DIRECTORY_SEPARATOR . $this->item->full_paper, false);?>">[View File]</a>
				<?php endif; ?>
				<input type="hidden" name="jform[full_paper]" id="jform_full_paper_hidden" value="<?php echo $this->item->full_paper ?>" />				<li><?php echo $this->form->getLabel('camera_ready'); ?>
				<?php echo $this->form->getInput('camera_ready'); ?></li>

				<?php if (!empty($this->item->camera_ready)) : ?>
						<a href="<?php echo JRoute::_(JUri::base() . 'components' . DIRECTORY_SEPARATOR . 'com_confmgt' . DIRECTORY_SEPARATOR . 'upload/camera' .DIRECTORY_SEPARATOR . $this->item->camera_ready, false);?>">[View File]</a>
				<?php endif; ?>
				<input type="hidden" name="jform[camera_ready]" id="jform_camera_ready_hidden" value="<?php echo $this->item->camera_ready ?>" />				<li><?php echo $this->form->getLabel('presentation'); ?>
				<?php echo $this->form->getInput('presentation'); ?></li>

				<?php if (!empty($this->item->presentation)) : ?>
						<a href="<?php echo JRoute::_(JUri::base() . 'components' . DIRECTORY_SEPARATOR . 'com_confmgt' . DIRECTORY_SEPARATOR . 'upload/presentations' .DIRECTORY_SEPARATOR . $this->item->presentation, false);?>">[View File]</a>
				<?php endif; ?>
				<input type="hidden" name="jform[presentation]" id="jform_presentation_hidden" value="<?php echo $this->item->presentation ?>" />				<li><?php echo $this->form->getLabel('full_review_outcome'); ?>
				<?php echo $this->form->getInput('full_review_outcome'); ?></li>

			<?php
				foreach((array)$this->item->full_review_outcome as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="full_review_outcome" name="jform[full_review_outcomehidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<li><?php echo $this->form->getLabel('abstract_review_outcome'); ?>
				<?php echo $this->form->getInput('abstract_review_outcome'); ?></li>

			<?php
				foreach((array)$this->item->abstract_review_outcome as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="abstract_review_outcome" name="jform[abstract_review_outcomehidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<li><?php echo $this->form->getLabel('full_review_comments'); ?>
				<?php echo $this->form->getInput('full_review_comments'); ?></li>
				<li><?php echo $this->form->getLabel('abstract_review_comments'); ?>
				<?php echo $this->form->getInput('abstract_review_comments'); ?></li>


            </ul>
        </fieldset>
    </div>

    

    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>