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

JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('jquery.ui');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);

?>
<?php if ($this->item) : ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo JText::_('COM_CONFMGT_AUTHOR_FORM_PANEL_HEADING'); ?></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_AUTHOR_FORM_PANEL_DETAILS'); ?></p>
  	</div>
    
    <table class="table table-striped">
    	<tr>
        	<td style="width:30%" class="header"> <?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_ID'); ?>: </td>
			<td> <?php echo $this->item->id; ?></td>
        </tr>
        <tr>
        	<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_TITLE'); ?>:</td>
            <td><?php echo $this->item->title; ?></td>
        </tr>
  
        <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_FIRSTNAME'); ?>:</td>
			<td><?php echo $this->item->firstname; ?></td>
        </tr>
        <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_SURNAME'); ?>:</td>
			<td><?php echo $this->item->surname; ?></td>
        </tr>
        <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_EMAIL'); ?>:</td>
			<td><?php echo $this->item->email; ?></td>
        </tr>
     	
	</table>
</div>
<div>
	<form id="form-author-list-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=authors'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
	<?php echo JHtml::_('form.token'); ?>
	<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_AUTHORS_LIST"); ?> </button>
	</form>
    
    <form id="form-author-new-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.edit&id='.$this->item->id); ?>" method="post" class="form-validate" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_EDIT_ITEM"); ?> </button>
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

