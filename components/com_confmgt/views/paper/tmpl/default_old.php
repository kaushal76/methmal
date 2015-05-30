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

JHtml::_('behavior.modal');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);

// TO-DO change this to Confmgt ACL
//$canEdit = JFactory::getUser()->authorise('core.edit', 'com_confmgt');
//Temp measure
$canEdit = true;

?>
<?php if ($this->item) : ?>
<div class="panel panel-default">
    <div class="panel-heading"><h1><?php echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_HEADING'); ?></h1></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_DETAILS'); ?></p>
  	</div>
    
    <table class="table">
    	<tr>
        	<td width="35%"> <?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ID'); ?>: </td>
			<td width="65%"> <?php echo $this->item->id; ?></td>
        </tr>
        <tr>
        	<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_TITLE'); ?>:</td>
            <td><?php echo $this->item->title; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT'); ?>: </td>
			<td><?php echo $this->item->abstract; ?></td>   
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_KEYWORDS'); ?>:</td>
			<td><?php echo $this->item->keywords; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_AUTHORS'); ?>:</td>
            <td><?php 
					echo '<ol>';
					foreach ($this->authors as $author) { 
						echo ('<li>'.$author->title.' '.$author->firstname.' '.$author->surname.'</li>');
					}
					echo '</ol>';
					
				?>
            </td>
        </tr>
        
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ORDERING'); ?>:</td>
            <td><?php echo $this->item->ordering; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_STATE'); ?>:</td>
			<td><?php echo $this->item->state; ?></td>
       	</tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CHECKED_OUT'); ?>:</td>
			<td><?php echo $this->item->checked_out; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CHECKED_OUT_TIME'); ?>:</td>
			<td><?php echo $this->item->checked_out_time; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CREATED_BY'); ?>:</td>
			<td><?php echo $this->item->created_by; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>:</td>

			<td>
            <a href="index.php?option=com_confmgt&amp;view=fullpapers&amp;linkid=<?php echo $this->linkid; ?>" >Full papers</a>
			</td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CAMERA_READY'); ?>:</td>

			<td>
            <a href="index.php?option=com_confmgt&amp;view=camerareadypapers&amp;linkid=<?php echo $this->linkid; ?>" >Camera ready papers</a>
            </td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_PRESENTATION'); ?>:</td>

			<td><?php 
				$uploadPath = 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_confmgt' . DIRECTORY_SEPARATOR . 'upload/presentations' . DIRECTORY_SEPARATOR . $this->item->presentation;
			?>
			<a href="<?php echo JRoute::_(JUri::base() . $uploadPath, false); ?>" target="_blank"><?php echo $this->item->presentation; ?></a></td>
        </tr>
        <tr>
            <td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_OUTCOME'); ?>:</td>
            <td><?php echo $this->item->full_review_outcome; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_OUTCOME'); ?>:</td>
			<td><?php echo $this->item->abstract_review_outcome; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_COMMENTS'); ?>:</td>
			<td><?php echo $this->item->full_review_comments; ?></td>
        </tr>
        <tr>
			<td><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_COMMENTS'); ?>:</td>
			<td><?php echo $this->item->abstract_review_comments; ?></td>
        </tr>
   
	</table>
</div>
<div>

    
	
	<form id="form-paper-list-<?php echo $this->item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
	<?php echo JHtml::_('form.token'); ?>
	<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_PAPERS_LIST"); ?> </button>
	</form>
	<?php if($canEdit): ?>
    
		<form id="form-paper-new-<?php echo $this->item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=paper.edit&id='.$this->linkid); ?>" method="post" class="form-validate" enctype="multipart/form-data">
		<?php echo JHtml::_('form.token'); ?>
		<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_EDIT_ITEM"); ?> </button>
		</form>
        

        
	<?php endif; ?>
	<?php 
	// TO-DO change this to Confmgt ACL
	//Temp measure
	
	//if(JFactory::getUser()->authorise('core.delete','com_confmgt')):
	?>
		<button class="btn btn-default" type="submit"><?php echo JText::_("COM_CONFMGT_DELETE_ITEM"); ?> </button>
        <form id="form-paper-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=paper.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
		<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
		<input type="hidden" name="option" value="com_confmgt" />
		<input type="hidden" name="task" value="paper.remove" />
		<?php echo JHtml::_('form.token'); ?>
		</form>
	<?php // endif;?>

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

