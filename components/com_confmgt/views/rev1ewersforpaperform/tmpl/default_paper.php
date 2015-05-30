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
    <h1>
      <?php
		echo JText::_('COM_CONFMGT_PAPER_PANEL_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
    </h1>
  </div>
  <div class="panel-body"> </div>
  <table class="table table-striped">
    <tr>
      <td width="25%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
			echo  $this->item->abstract_review_outcome_text;
		?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
			echo nl2br ($this->item->abstract_review_comments);
		?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>
        :</td>
      <td><?php
			echo $this->item->full_paper;
			echo $this->item->full_paper_download;
		?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
		
			echo $this->item->full_review_outcome_text;
		?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
		
			echo nl2br ($this->item->full_review_comments);
		?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CAMERA_READY'); ?>
        :</td>
      <td><?php
	
			echo $this->item->camera_ready;
		?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_PRESENTATION'); ?>
        :</td>
      <td><?php
	
			echo $this->item->presentation;
		?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CREATED_BY'); ?>
        :</td>
      <td><?php
		echo $this->item->created_by_name; ?></td>
    </tr>
  </table>
</div>
