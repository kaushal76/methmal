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
      <td class="header" style="width:30%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
			echo $this->item->abstract_review_outcome;
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
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>
        :</td>
      <td><?php
	
			echo $this->item->full_paper;
			echo $this->item->full_paper_download;
		
		?>
        
        </td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
			echo nl2br($this->item->full_review_outcome);
			if (!empty($this->item->fullPaperBtn)) {
				echo $this->item->fullPaperBtn;
			}	
		?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
			echo $this->item->full_review_comments;
		?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CAMERA_READY'); ?>
        :</td>
      <td><?php
		if ($this->camerareadypapers)
		{
			echo '<ol>';
			foreach($this->camerareadypapers as $camerareadypaper)
			{
				echo ('<li>' . $camerareadypaper->cameraready_paper . ' (' . $camerareadypaper->type . ')</li>');
			}
			echo '</ol>';
		}
		else
		{
			echo $this->item->camera_ready;
			if (!empty($this->item->cameraReadyBtn)) {
				echo $this->item->cameraReadyBtn;
			}
		}?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_PRESENTATION'); ?>
        :</td>
      <td><?php
		if ($this->presentations)
		{
			echo '<ol>';
			foreach($this->presentations as $presentation)
			{
				echo ('<li>' . $presentation->presentation . ' (' . $presentation->type . ')</li>');
			}
			echo '</ol>';
		}
		else
		{
			echo $this->item->presentation;
			if (!empty($this->item->presentationBtn)) {
				echo $this->item->presentationBtn;
			}
		}?></td>
    </tr>
  </table>
</div>
<form id="form-paper-list-<?php
		echo $this->item->id ?>" style="display:inline" action="<?php
		echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
  <?php
		echo JHtml::_('form.token'); ?>
  <input type="hidden" name="option" value="com_confmgt" />
  <input type="hidden" name="view" value="papers" />
  <button class="btn btn-default" type="submit">
  <?php
		echo JText::_("COM_CONFMGT_PAPERS_LIST"); ?>
  </button>
</form>