<?php
/**
 * @version     2.5.8.1
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

$url = "components/com_confmgt/assets/js/bootbox.min.js";
$document = JFactory::getDocument ();
$document->addScript( $url );

?>
<script type="text/javascript">
function deleteItem(item_id){
	bootbox.confirm("Do you really want to delete this paper? Once deleted it is irrecoverable", "Cancel", "Delete", function(result) {
	    if (result) {
	    	document.getElementById('form-paper-delete-' + item_id).submit();
	    } 
	});
}
</script>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_PAPERS_FORM_PANEL_HEADING'); ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_PAPERS_FORM_PANEL_DETAILS'); ?></p>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th><?php echo JText::_("COM_CONFMGT_ID"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_TITLE"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_THEME"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_SUBMITTED_ON"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_ACTION"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $show = false; ?>
      <?php foreach ($this->items as $item) : ?>
      <?php $show = true; ?>
      <tr>
        <td width="5%"><?php echo $item->id; ?></td>
        <td><?php echo $item->title; ?></td>
        <td><?php echo $item->themename; ?></td>
        <td><?php echo $item->last_updated; ?></td>
        <td><form id="form-paper-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="paper.remove" />
            <button type="button" class="btn btn-danger" onclick="javascript:deleteItem(<?php echo $item->id; ?>);"><i class="icon-trash icon-white"></i></button>
            <?php echo JHtml::_('form.token'); ?>
          </form>
          <form id="form-paper-edit-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="linkid" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="paper" />
            <button type="submit" class="btn btn-genral"><i class="icon-file"></i></button>
            <?php echo JHtml::_('form.token'); ?>
          </form></td>
      </tr>
      <?php endforeach; ?>
      <?php
        if (!$show){ ?>
      <tr>
        <td colspan="5"><?php 
            echo JText::_('COM_CONFMGT_NO_ITEMS');
		?></td>
      </tr>
      <?php  } ?>
    </tbody>
  </table>
</div>
<div class="inline">
  <form id="form-entrypage-<?php echo $item->id ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit">
    <i class="icon-home"></i>
	<?php echo JText::_("COM_CONFMGT_ENTRY_PAGE"); ?>
    </button>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="view" value="entrypage" />
  </form>
 </div>
 <div class="inline">
  <form id="form-paper-new-<?php echo $item->id ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit">
    <i class="icon-plus"></i>
	<?php echo JText::_("COM_CONFMGT_ADD_PAPER"); ?>
    </button>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="task" value="paper.newabstract" />
  </form>
</div>
