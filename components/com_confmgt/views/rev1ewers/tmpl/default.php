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

JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('bootstrap.modal');
JHtml::_('bootstrap.alert', 'error');

?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_CONFMGT_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-rev1ewer-delete-' + item_id).submit();
        }
    }
</script>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_REVIEWERS_FORM_PANEL_HEADING'); ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_REVIEWERS_FORM_PANEL_DETAILS'); ?></p>
  </div>
  <table class="admintable table table-striped">
    <thead>
      <tr>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWER_NUMBER"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWER_NAME"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWER_AGREED"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWER_ADDED_BY"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWER_PAPERS"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_ACTION"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php 

$show = false; 
$leader = $this->leader;
?>
      <?php foreach ($this->items as $item) : ?>
      <?php $show = true; ?>
      <tr>
        <td width="5%"><?php echo $item->ordering; ?></td>
        <td><?php echo $item->title.' '.$item->firstname.' '.$item->surname; ?></td>
        <td><?php 
			  if ($item->agreed ==1) {
				  echo JText::_("COM_CONFMGT_REVIEWER_YES"); 
			  }elseif ($item->agreed ==0) {
				  echo JText::_("COM_CONFMGT_REVIEWER_NO");
			  }else{
				  echo JText::_("COM_CONFMGT_REVIEWER_PENDING");
			  }
		?></td>
        <td><?php echo JFactory::getUser($item->created_by)->name; ?></td>
        <td><?php echo $item->papers; ?></td>
        <td> 
        <div class="inline">
          <form id="form-rev1ewer-delete-<?php echo $item->id; ?>" style = "display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <button type="button" class="btn btn-danger" onclick="javascript:deleteItem(<?php echo $item->id; ?>);"><i class="icon-trash icon-white"></i></button>
            <input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="rev1ewer.remove" />
            <?php echo JHtml::_('form.token'); ?>
          </form>
          </div>
          <div class="inline">
          <form id="form-rev1ewer-edit-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data" >
            <button class="btn btn" type="submit"><i class="icon-edit"></i></button>
            <input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="rev1ewer.edit" />
            <?php echo JHtml::_('form.token'); ?>
          </form>
          </div>
          <div class="inline">
          <form id="form-rev1ewer-notify-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data" >
            <button class="btn btn" type="submit"><i class="icon-envelope"></i></button>
            <input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="revid" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="rev1ewer.notify" />
            <?php echo JHtml::_('form.token'); ?>
          </form>
          </div>
		</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
    <?php
        if (!$show){ ?>
    <tr>
      <td colspan="6"><?php 
            echo JText::_('COM_CONFMGT_NO_ITEMS');
		?></td>
    </tr>
    <?php
			$newBtn = JText::_("COM_CONFMGT_ADD_REVIEWER");
			$nxtBtnDisable = " disabled = disabled";
		}else{
			$newBtn = JText::_("COM_CONFMGT_ADD_ANOTHER_REVIEWER");
			$nxtBtnDisable = "";
        }
        ?>
    <tfoot>
      <?php if ($show): ?>
    <div class="pagination">
      <p class="counter"> <?php //echo $this->pagination->getPagesCounter(); ?> </p>
      <?php //echo $this->pagination->getPagesLinks(); ?> </div>
    <?php endif; ?>
      </tfoot>
    
  </table>
</div>
<div>
  <?php 
 //TO-DO change the default ACL to confmgt ACL 
//if(JFactory::getUser()->rev1ewerise('core.create','com_confmgt')): ?>
  <form id="form-rev1ewer-new" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=rev1ewer.edit&id=0'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <input type="hidden" name="linkid" value="<?php echo $linkid; ?>" />
    <button class="btn btn-default btn-lg" type="submit"><?php echo $newBtn; ?> </button>
  </form>
  <form id="form-rev1ewer-list" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=papers&layout=leader_default'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit"><?php echo JText::_("COM_CONFMGT_REVIEWERS_BACK"); ?> </button>
  </form>
  <?php //endif; ?>
</div>
