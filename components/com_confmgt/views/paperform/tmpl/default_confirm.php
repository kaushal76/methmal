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

<div class="alert alert-block alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4 class="alert-heading"><?php echo JText::_('Review results have been posted to the authors'); ?> </h4>
  <p><?php echo JText::_('This will submit your abstract to the system and the conference organisors will be notified. Procced with the submission?.'); ?> </p>
  <form id="form-paper-confirm" role="form" action="<?php echo jroute::_('index.php?option=com_confmgt&task=paperform.save'); ?> 
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
   <div class="control-group">
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo JText::_('Yes'); ?> </button>
            <?php echo JText::_('or'); ?> <a href="<?php echo jroute::_('index.php?option=com_confmgt&task=paperform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>
				"><?php echo JText::_('JCANCEL'); ?> </a>
            <input type="hidden" name="option" value="com_confmgt"/>
            <input type="hidden" name="linkid" value="<?php echo $this->linkid; ?>" />
            <input type="hidden" name="task" value="paperform.save"/>
            <?php echo JHtml::_('form.token'); ?> </div>
        </div>
  
</div>