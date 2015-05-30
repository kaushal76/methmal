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
<h1><?php echo JText::_('Paper Details'); ?></h1> 
<div>
  <table class="table table-striped">
 	<tr>
      <td class="header" style="width:30%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ABSTRACT'); ?>
        : </td>
      <td><?php echo nl2br($this->item->abstract); ?></td>
      <td style="width:15%">&nbsp;</td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_KEYWORDS'); ?>
        :</td>
      <td>
	  <div 
      class = "edit" 
      id="keywords" 
      data-type="text" 
      data-pk="<?php echo $this->item->id; ?>" 
      data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=paperform.save_ajax&tmpl=component&format=raw'); ?>" 
      data-title="Enter Keywords" 
      data-name = "keywords">
	  <?php echo $this->item->keywords; ?>
      </div>
      </td>
      <td>
        <button class="btn edit_keywords" type="submit"><i class="icon-edit"></i></button>
      </td>
    </tr>
    <tr>
        <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>
        :</td>
      <td><?php echo $this->item->full_paper_txt; ?> </td>
      <td><?php echo $this->item->full_paper_download; ?></td>     
       </tr>
          <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CAMERA_READY'); ?>
        :</td>
      <td><?php echo $this->item->camera_ready_txt; ?></td>
      <td><?php echo $this->item->cameraready_download; ?>
	      <?php echo $this->item->cameraReadyBtn;?>
      </td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_PRESENTATION'); ?>
        :</td>
      <td><?php echo $this->item->presentation_txt; ?> </td>
      <td><?php echo $this->item->presentationBtn ?><?php echo $this->item->presentation_download ?></td>
    </tr>
  </table>
</div>
</div>