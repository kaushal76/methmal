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
<h1><?php echo JText::_('Reviews'); ?></h1> 
<div>
  <table class="table table-striped">
    <tr>
      <td class="header" style="width:30%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
			echo $this->item->abstract_review_outcome_txt;
			if (!empty($this->item->abstractBtn)) {
				echo $this->item->abstractBtn;
			}
	?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
			echo nl2br($this->item->abstract_review_comments);
		?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
			echo nl2br($this->item->full_review_outcome_txt);
			if (!empty($this->item->fullPaperBtn)) {
				echo $this->item->fullPaperBtn;
				echo $this->item->full_paper_download;
			}	
		?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
			echo nl2br ($this->item->full_review_comments);
		?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CAMERA_READY'); ?>
        :</td>
      <td><?php
			echo $this->item->camera_ready_txt;
			echo $this->item->cameraReadyBtn;
			echo $this->item->cameraready_download;
		?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_PRESENTATION'); ?>
        :</td>
      <td><?php
		
			echo $this->item->presentation_txt;
			if (!empty($this->item->presentationBtn)) {
				echo $this->item->presentationBtn;
			}
			echo $this->item->presentation_download;
		?></td>
    </tr>
  </table>
</div>
</div>