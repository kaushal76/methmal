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
?>
<div class="panel panel-default">
<h1><?php echo JText::_('Authors'); ?></h1> 
<div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="5%"><?php echo JText::_('#'); ?></th>
        <th><?php echo JText::_('Name'); ?> </th>
        <th width="15%"><?php echo JText::_('Action'); ?> </th>
      </tr>
    </thead>
    <tbody>
      <?php
		if ($this->authors)
		{ 
			$i=1;
      foreach($this->authors as $author)
			{ ?>
      <tr>
        <td><?php
		echo $i; ?></td>
        <td><?php	echo $author->title . ' ' . $author->firstname . ' ' . $author->surname; ?></td>
        <td>

        <form id="form-author-delete-<?php echo $item->id; ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" style="display:inline" enctype="multipart/form-data">
        <button type="button" class="btn btn-danger" onclick="javascript:deleteItem(<?php echo $author->id; ?>);"><i class="icon-trash icon-white"></i></button>
            <input type="hidden" name="jform[id]" value="<?php echo $author->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="task" value="author.remove_update" /> 
            <?php echo JHtml::_('form.token'); ?>
        </form>
        <form id="form-author-edit-<?php echo $item->id; ?>" action="<?php echo JRoute::_('index.php') ?>" method="post" class="form-validate" style="display:inline" enctype="multipart/form-data">
        <button class="btn" type="submit"><i class="icon-edit"></i></button>
            <input type="hidden" name="jform[id]" value="<?php echo $author->id; ?>" />
            <input type="hidden" name="id" value="<?php echo $author->id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="author" />
            <input type="hidden" name="layout" value="default_ajax" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
        </td>
      </tr>
      <?php 	
	  		$i=$i+1;
			}
		}?>
    </tbody>
  </table>
</div>
<div class="inline">
<form id="form-authors-reorder" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
  <?php echo JHtml::_('form.token'); ?>
  <input type="hidden" name= "linkid" value="<?php echo $this->item->id; ?>" />
  <input type="hidden" name="option" value="com_confmgt" />
  <input type="hidden" name="view" value="authors" />
  <input type="hidden" name="layout" value="reorder" />
  <button class="btn btn-default btn-sm" type="submit">
  <i class="icon-edit"></i>
  <?php echo JText::_("Edit author sequence"); ?>
  </button>
</form>
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
</div>