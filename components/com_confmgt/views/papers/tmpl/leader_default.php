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

?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1><?php echo JText::_('COM_CONFMGT_LEADERS_PAPERS_FORM_PANEL_HEADING'); ?></h1>
  </div>
  <div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_LEADRRS_PAPERS_FORM_PANEL_DETAILS'); ?></p>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="5%"><?php echo JText::_("COM_CONFMGT_ID"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_TITLE"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_AUTHOR"); ?></th>
        <th><?php echo JText::_("COM_CONFMGT_PAPERS_THEME"); ?></th>
        <th width="10%"><?php echo JText::_("COM_CONFMGT_PAPERS_STUDENT"); ?></th>
        <th width="10%"><?php echo JText::_("COM_CONFMGT_PAPERS_REV_ALLOCATED"); ?></th>
        <th width="10%"><?php echo JText::_("COM_CONFMGT_PAPERS_AB_REV_POSTED"); ?></th>
        <th width="10%"><?php echo JText::_("COM_CONFMGT_PAPERS_FULL_REV_POSTED"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $show = false; ?>
      <?php foreach ($this->leadersitems as $item) : ?>
      <?php $show = true; ?>
      <tr>
        <td width="5%"><?php echo $item->id; ?></td>
        <td><?php echo $item->title; ?></td>
        <td><?php echo $item->author; ?></td>
        <td><?php echo  $item->theme; ?></td>
        <td><?php echo JText::_("COM_CONFMGT_PAPERS_STUDENT_".$item->student_submission); ?></td>
        <td>
        <a href="<?php echo JRoute::_('index.php?option=com_confmgt&view=rev1ewersforpaperform&linkid='.(int)$item->id); ?>">
		<?php echo $item->rev1ewers;?></a>
        </td>
        <td>
		<?php if ($item->abstract_review_outcome == 0) { ?><a href="<?php echo JRoute::_('index.php?option=com_confmgt&view=abrev1ewoutcomeform&linkid='.(int)$item->id); ?>">
		<?php echo JText::_("No");?></a>
		<?php }else{ ?>
        <a href="<?php echo JRoute::_('index.php?option=com_confmgt&view=abrev1ewoutcomeform&linkid='.(int)$item->id); ?>">
		<?php echo JText::_("Yes");?></a>
		<?php } ?>
        </td>
        <td>
		<?php if (empty($item->full_paper)) { 
		echo JText::_("Full paper not submitted");
		}elseif ((!empty($item->full_paper))&&($item->full_review_outcome == 0)) {?>
        <a href="<?php echo JRoute::_('index.php?option=com_confmgt&view=fullrev1ewoutcomeform&linkid='.(int)$item->id); ?>">
		<?php echo JText::_("No"); ?></a>
		<?php }else{ ?> <a href="<?php echo JRoute::_('index.php?option=com_confmgt&view=fullrev1ewoutcomeform&linkid='.(int)$item->id); ?>"><?php echo JText::_("Yes"); ?></a>
		<?php } ?>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (!$show){ ?>
      <tr>
        <td colspan="8"><?php 
            echo JText::_('COM_CONFMGT_NO_ITEMS');
		?></td>
      </tr>
      <?php  } ?>
    </tbody>
  </table>
</div>
<div class="inline">
  <form id="form-entrypage" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
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
  <form id="form-reviewers-list" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit">
    <i class="icon-list"></i>
    <?php echo JText::_("COM_CONFMGT_LEADER_REVIEWERS_LIST"); ?>
    </button>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="view" value="rev1ewers" />
  </form>
</div>
