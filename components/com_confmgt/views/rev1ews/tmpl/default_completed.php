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
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_REVIEWS_PANEL_COMPLETED_HEADING'); ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_REVIEWS_PANEL_COMPLETED_DETAILS'); ?></p>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="5%"><?php echo JText::_("COM_CONFMGT_REVIEWS_NUM"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWS_TITLE"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWS_MODE"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWS_COMPLETED_ON"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_REVIEWS_VIEW_REVIEW"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $show = false; ?>
      <?php if ($this->items_completed): ?>
      <?php foreach ($this->items_completed as $item) : ?>
      <?php if ($item->mode =='abstract') {
				$layout = 'abstract';
				$btn = JText::_('View Abstract Review');
			}elseif ($item->mode =='full') {
				$layout = 'full';
				$btn = JText::_('View Full paper Review');
			}	  
	   ?>
      <?php $show = true; ?>
      <tr>
        <td width="5%"><?php echo $item->id; ?></td>
        <td><?php echo $item->title; ?></td>
        <td><?php echo $item->mode; ?></td>
        <td><?php echo $item->last_updated; ?></td>
        <td><form id="form-paper-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
            <input type="hidden" name="jform['linkid']" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="linkid" value="<?php echo $item->id; ?>" />
            <input type="hidden" name="rev_id" value="<?php echo $item->rev_id; ?>" />
            <input type="hidden" name="option" value="com_confmgt" />
            <input type="hidden" name="view" value="rev1ew" />
            <input type="hidden" name="layout" value="<?php echo $layout; ?>" />
            <button type="submit" class="btn btn-genral"><?php echo $btn; ?></button>
            <?php echo JHtml::_('form.token'); ?>
          </form></td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
   	<tfoot>
      <?php if ($show): ?>
    <div class="pagination">
      <p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
      <?php echo $this->pagination->getPagesLinks(); ?> </div>
    <?php endif; ?>
    </tfoot>
  </table>
     <?php if (!$show): ?>
    <div class="panel-body"><p> 
    <?php
            echo JText::_('COM_CONFMGT_NO_ITEMS');
	?>
    </p>
	</div>
    <?php endif; ?>
</div>
