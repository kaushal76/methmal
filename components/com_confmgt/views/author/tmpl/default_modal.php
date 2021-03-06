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
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('bootstrap.modal');
JHtml::_('bootstrap.alert', 'error');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);

//adding overriding styles
$url = "http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap-editable/css/bootstrap-editable.css";
$document = JFactory::getDocument();
$document->addStyleSheet($url);

$url = "http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap-editable/js/bootstrap-editable.min.js";
$document = JFactory::getDocument();
$document->addScript($url);

$url = "components/com_confmgt/assets/js/view.author.ajax.js";
$document = JFactory::getDocument();
$document->addScript($url);

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
			<td><?php echo $this->item->id; ?></td>
        </tr>
        <tr>
        	<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_TITLE'); ?>:</td>
            <td>
			<div 
            class = "edit" 
            id="title" 
            data-type="text" 
            data-pk="<?php echo $this->item->id; ?>" 
            data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.save_ajax&tmpl=component&format=raw'); ?>" 
            data-title="Enter author's Title" 
            data-name = "title">
            <?php echo $this->item->title; ?>
      		</div>
            
            </td>
        </tr>
  
        <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_FIRSTNAME'); ?>:</td>
			<td>
			<div 
            class = "edit" 
            id="firstname" 
            data-type="text" 
            data-pk="<?php echo $this->item->id; ?>" 
            data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.save_ajax&tmpl=component&format=raw'); ?>" 
            data-title="Enter author's First name" 
            data-name = "firstname">
            <?php echo $this->item->firstname; ?>
      		</div>
            </td>
        </tr>
        <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_SURNAME'); ?>:</td>
			<td>
			<div 
            class = "edit" 
            id="surname" 
            data-type="text" 
            data-pk="<?php echo $this->item->id; ?>" 
            data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.save_ajax&tmpl=component&format=raw'); ?>" 
            data-title="Enter author's Surname" 
            data-name = "surname">
            <?php echo $this->item->surname; ?>
      		</div>
            </td>
        </tr>
        <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_EMAIL'); ?>:</td>
			<td>
			<div 
            class = "edit" 
            id="email" 
            data-type="text" 
            data-pk="<?php echo $this->item->id; ?>" 
            data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.save_ajax&tmpl=component&format=raw'); ?>" 
            data-title="Enter author's email" 
            data-name = "email">
            <?php echo $this->item->email; ?>
      		</div>
            </td>
        </tr>
         <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_INSTITUTION'); ?>:</td>
			<td>
			<div 
            class = "edit" 
            id="institution" 
            data-type="text" 
            data-pk="<?php echo $this->item->id; ?>" 
            data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.save_ajax&tmpl=component&format=raw'); ?>" 
            data-title="Enter author's Institution" 
            data-name = "institution">
            <?php echo $this->item->institution; ?>
      		</div>
            </td>
        </tr>
        <tr>
			<td class="header"><?php echo JText::_('COM_CONFMGT_FORM_LBL_AUTHOR_COUNTRY'); ?>:</td>
			<td>
			<div 
            class = "edit" 
            id="country" 
            data-type="text" 
            data-pk="<?php echo $this->item->id; ?>" 
            data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.save_ajax&tmpl=component&format=raw'); ?>" 
            data-title="Enter the author's country" 
            data-name = "country">
            <?php echo $this->item->country; ?>
      		</div>
            </td>
        </tr>
     	
	</table>
</div>
<div>
	<form id="form-author-list-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=paper&id='.$this->item->linkid); ?>" method="post" class="form-validate" enctype="multipart/form-data">
	<?php echo JHtml::_('form.token'); ?>
	<button class="btn btn-default" type="submit"><?php echo JText::_("Done"); ?> </button>
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

