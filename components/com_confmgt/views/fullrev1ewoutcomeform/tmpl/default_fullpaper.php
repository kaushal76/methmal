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
		echo JText::_('COM_CONFMGT_PAPER_ABSRTACT_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
      </h1>
    </div>
    <table class="table table-striped">
      <tr>
        <td width="23%" class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ID'); ?>
          : </td>
        <td width="77%"><?php
		echo $this->item->id; ?></td>
      </tr>
      <tr>
        <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_TITLE'); ?>
          :</td>
        <td><?php
		echo $this->item->title; ?></td>
      </tr>
      <tr>
        <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_FULL_PAPER'); ?>
          : </td>
        <td><?php
		echo $this->item->full_paper; 
		echo $this->item->full_paper_download; 
		
		?>
        
        </td>
      </tr>
      <tr>
        <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_KEYWORDS'); ?>
          :</td>
        <td><?php
		echo $this->item->keywords; ?></td>
      </tr>
    </table>
  </div>

