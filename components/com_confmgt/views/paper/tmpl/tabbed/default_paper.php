<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// no direct access

defined('_JEXEC') or die;?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h1>
      <?php
		echo JText::_('COM_CONFMGT_PAPER_PAPER_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
    </h1>
  </div>
  <div class="panel-body">
  </div>
  <table class="table table-striped">
 	<tr>
      <td class="header" style="width:30%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT'); ?>
        : </td>
      <td><?php
		echo nl2br($this->item->abstract); ?></td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_KEYWORDS'); ?>
        :</td>
      <td><?php
		echo $this->item->keywords; ?></td>
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

    <div>
      <form id="form-abstract-new-<?php echo $this->item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <?php echo JHtml::_('form.token'); ?>
        <input type="hidden" name="option" value="com_confmgt" />
        <input type="hidden" name="task" value="paper.edit" />
        <input type="hidden" name="id" value="<?php echo $this->linkid; ?>" />
        <button class="btn btn-default btn-sm" type="submit">
        <?php echo JText::_("COM_CONFMGT_EDIT_ABSRTACT"); ?>
        </button>
      </form>
    </div>