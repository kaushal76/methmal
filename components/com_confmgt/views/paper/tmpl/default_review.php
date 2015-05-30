<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - http://www.confmgt.com
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
      <td width="35%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_OUTCOME'); ?>
        :</td>
      <td width="65%"><?php
		if ($this->item->abstract_review_outcome == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->abstract_review_outcome;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
		if ($this->item->abstract_review_comments == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->abstract_review_comments;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>
        :</td>
      <td><?php
		if ($this->fullpapers)
		{
			echo '<ol>';
			foreach($this->fullpapers as $fullpaper)
			{
				echo ('<li>' . $fullpaper->full_paper . ' (' . $fullpaper->type . ')</li>');
			}
			echo '</ol>';
		}
		else
		{
			echo JText::_('N/A');
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_OUTCOME'); ?>
        :</td>
      <td><?php
		if ($this->item->full_review_outcome == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->full_review_outcome;
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_REVIEW_COMMENTS'); ?>
        :</td>
      <td><?php
		if ($this->item->full_review_comments == '')
		{
			echo JText::_('N/A');
		}
		else
		{
			echo $this->item->full_review_comments;
		}?></td>
    </tr>
    <tr>
      <td><?php
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
			echo JText::_('N/A');
		}?></td>
    </tr>
    <tr>
      <td><?php
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
			echo JText::_('N/A');
		}?></td>
    </tr>
    <tr>
      <td><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CREATED_BY'); ?>
        :</td>
      <td><?php
		echo $this->item->created_by; ?></td>
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