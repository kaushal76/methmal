<?php
/**
 * @version     2.5.1
 * @package     com_confmgt
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @rev1ewer      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);

// TO-DO change this to Confmgt ACL
/*
$canEdit = JFactory::getUser()->rev1ewerise('core.edit', 'com_confmgt');
if (!$canEdit && JFactory::getUser()->rev1ewerise('core.edit.own', 'com_confmgt')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
*/
?>
<?php if ($this->item) : ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo JText::_('COM_CONFMGT_REVIEWER_FORM_PANEL_HEADING'); ?></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_REVIEWER_FORM_PANEL_DETAILS'); ?></p>
  	</div>
    
    <table class="table">
    	<tr>
        	<td width="35%"> <?php echo JText::_('COM_CONFMGT_FORM_LBL_REVIEWER_ID'); ?>: </td>
			<td width="65%"> <?php echo $this->item->id; ?></td>
        </tr>
        <tr>
        	<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_REVIEWER_TITLE'); ?>:</td>
            <td><?php echo $this->item->title; ?></td>
        </tr>
  
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_REVIEWER_FIRSTNAME'); ?>:</td>
			<td><?php echo $this->item->firstname; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_REVIEWER_SURNAME'); ?>:</td>
			<td><?php echo $this->item->surname; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_REVIEWER_EMAIL'); ?>:</td>
			<td><?php echo $this->item->email; ?></td>
        </tr>
     	
	</table>
</div>
<div>

    
	
	<form id="form-rev1ewer-list-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=rev1ewers'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
	<?php echo JHtml::_('form.token'); ?>
	<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_REVIEWERS_LIST"); ?> </button>
	</form>
    
		<form id="form-rev1ewer-new-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=rev1ewer.edit&id='.$this->item->id); ?>" method="post" class="form-validate" enctype="multipart/form-data">
		<?php echo JHtml::_('form.token'); ?>
		<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_EDIT_ITEM"); ?> </button>
		</form>
        

        
		
        <form id="form-rev1ewer-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=rev1ewer.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_DELETE_ITEM"); ?> </button>
		<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
		<input type="hidden" name="option" value="com_confmgt" />
		<input type="hidden" name="task" value="rev1ewer.remove" />
		<?php echo JHtml::_('form.token'); ?>
		</form>
	

</div>
<?php
else:
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_HEADING'); ?></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_ITEM_NOT_LOADED'); ?></p>
  	</div>
</div>
<?php    
endif;
?>

