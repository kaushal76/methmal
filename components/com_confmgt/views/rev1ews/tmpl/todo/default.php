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
            document.getElementById('form-paper-delete-' + item_id).submit();
        }
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
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_ABSRTACT_REVIEW"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_FULL_PAPER"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_FULL_PAPER_REVIEW"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_CAMERA_READY_PAPER"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_SUBMITTED_ON"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_ACTION"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $show = false; ?>
      <?php foreach ($this->items as $item) : ?>
      <?php $show = true; ?>
      <tr>
        <td width="4%"><?php echo $item->id; ?></td>
        <td width="12%"><?php echo $item->title; ?></td>
        <td width="12%"><?php echo $item->themename; ?></td>
        <td width="12%"><a data-toggle="modal" href="<?php echo JRoute::_('index.php?option=com_confmgt&view=loginform&layout=modal&tmpl=component'); ?>" data-target="#paper-list-modal"><?php echo $item->abstract_review_outcome; ?></a></td>
        <td width="12%"><a data-toggle="modal" href="<?php echo JRoute::_('index.php?option=com_confmgt&view=paper&amp;id='.$item->id.'&tmpl=component'); ?>" data-target="#paper-list-modal"><?php echo $item->full_paper; ?></a></td>
        <td width="12%"><?php echo $item->full_review_outcome; ?></td>
        <td width="12%"><?php echo $item->camera_ready; ?></td>
        <td width="12%"><?php echo $item->last_updated; ?></td>
        <td width="12%"><form id="form-paper-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="paper.remove" />
            <button type="button" class="btn btn-danger" onclick="javascript:deleteItem(<?php echo $item->id; ?>);"><?php echo '<span class="glyphicon glyphicon-trash"></span>';  ?></button>
            <?php echo JHtml::_('form.token'); ?>
          </form>
          <form id="form-paper-edit-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="linkid" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="paper" />
            <button type="submit" class="btn btn-genral"><?php echo '<span class="glyphicon glyphicon-pencil"></span>';  ?></button> 
            <?php echo JHtml::_('form.token'); ?>
          </form></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
    <?php
        if (!$show):
            echo JText::_('COM_CONFMGT_NO_ITEMS');
        endif;
        ?>
    <tfoot>
      <?php if ($show): ?>
    <div class="pagination">
      <p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
      <?php echo $this->pagination->getPagesLinks(); ?> </div>
    <?php endif; ?>
      </tfoot>
    
  </table>
</div>
<div>
  <form id="form-entrypage-<?php echo $item->id ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit"><?php echo JText::_("COM_CONFMGT_ENTRY_PAGE"); ?> </button>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="view" value="entrypage" />
  </form>
  <form id="form-paper-new-<?php echo $item->id ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit"><?php echo JText::_("COM_CONFMGT_ADD_PAPER"); ?> </button>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="task" value="paper.newabstract" />
  </form>
</div>
<?php
 echo $this->loadTemplate('modal'); 
 ?>