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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.modal');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
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
            js('#form-camerareadypaper').submit(function(event){
                
				if(js('#jform_full_paper').val() != ''){
					js('#jform_full_paper_hidden').val(js('#jform_full_paper').val());
				}
				if(js('#jform_camera_ready').val() != ''){
					js('#jform_camera_ready_hidden').val(js('#jform_camera_ready').val());
				}
				if(js('#jform_presentation').val() != ''){
					js('#jform_presentation_hidden').val(js('#jform_presentation').val());
				} 
            }); 
        
            
        });
    });
    
</script>

<div class="camerareadypaper-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-camerareadypaper" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=camerareadypaper.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <ul>
            
        </ul>

        <div>
            <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
            <?php echo JText::_('or'); ?>
            <a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=camerareadypaperform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="camerareadypaperform.save" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
