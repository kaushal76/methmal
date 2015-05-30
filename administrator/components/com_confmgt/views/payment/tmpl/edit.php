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
                if (task == 'payment.cancel') {
                    Joomla.submitform(task, document.getElementById('payment-form'));
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
                    if (task != 'payment.cancel' && document.formvalidator.isValid(document.id('payment-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('payment-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }
        });
    });
</script>

<form action="<?php echo JRoute::_('index.php?option=com_confmgt&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="payment-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_CONFMGT_LEGEND_PAYMENT'); ?></legend>
            <ul class="adminformlist">

                

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