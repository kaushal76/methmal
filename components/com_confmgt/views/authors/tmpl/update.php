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
JHtml::_('bootstrap.modal');
JHtml::_('bootstrap.alert', 'error');
?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_CONFMGT_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-author-delete-' + item_id).submit();
        }
    }
</script>
<div class="panel panel-default">
 <div class="panel-heading"><h1><?php echo JText::_('COM_CONFMGT_AUTHORS_FORM_UPDATE_PANEL_HEADING'); ?></h1></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_AUTHORS_FORM_UPDATE_PANEL_DETAILS'); ?></p>
  	</div>
<table class="admintable table table-striped">
<thead>
<tr>
<th><?php echo JText::_("COM_CONFMGT_AUTHOR_NUMBER"); ?></th>
<th><?php echo JText::_("COM_CONFMGT_NAME"); ?></th>
<th><?php echo JText::_("COM_CONFMGT_ACTION"); ?></th>
</tr>
</thead>
<tbody>

<?php 

$show = false; 
$linkid = $this->linkid;

?>
<?php foreach ($this->items as $item) : ?>
  <?php 
		  $show = true;
		  ?>
		  <tr>
			  <td width="5%">
			  <?php echo $item->ordering; ?>
			  </td>
			  <td>
			  <?php echo $item->title.' '.$item->firstname.' '.$item->surname; ?>
			  </td>
			   <td width="15%">

				<form id="form-author-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
				<button type="button" class="btn btn-danger" onclick="javascript:deleteItem(<?php echo $item->id; ?>);"><i class="icon-trash icon-white"></i></button>
				<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
				<input type="hidden" name="option" value="com_confmgt" />
				<input type="hidden" name="task" value="author.remove_update" /> 
				<?php echo JHtml::_('form.token'); ?>
				</form
				><form id="form-author-edit-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php') ?>" method="post" class="form-validate" enctype="multipart/form-data">
				<button class="btn" type="submit"><i class="icon-pencil"></i></button>
				<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
				<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
				<input type="hidden" name="option" value="com_confmgt" />
				<input type="hidden" name="view" value="authorform" />
				<input type="hidden" name="layout" value="update_form" />
					<?php echo JHtml::_('form.token'); ?>
				</form>

			  </td>
			 </tr>

<?php endforeach; ?>

</tbody>
<tfoot>

<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>
</tfoot>
</table>	
</div>
<div class="inline">
<form id="form-author-new" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=author.edit_update&id=0'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
<?php echo JHtml::_('form.token'); ?>
<input type="hidden" name="linkid" value="<?php echo $linkid; ?>" />
<button class="btn btn-default btn-lg" type="submit">
<i class="icon-plus"></i>
<?php echo JText::_("Add new author"); ?>
</button>
</form>
</div>
<div class="inline">
<form id="form-author-new" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=paper&id='.$linkid); ?>" method="post" class="form-validate" enctype="multipart/form-data">
<?php echo JHtml::_('form.token'); ?>
<button class="btn btn-default btn-lg" <?php echo $nxtBtnDisable; ?> type="submit">
<i class="icon-check"></i>
<?php echo JText::_("Done"); ?>
</button>
</form>
</div>
