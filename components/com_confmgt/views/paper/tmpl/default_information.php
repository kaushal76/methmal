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

$url = "components/com_confmgt/assets/js/view.paper.information.js";
$document = JFactory::getDocument();
$document->addScript($url);

?>
<div class="panel panel-default">
<h1><?php echo JText::_('General Information'); ?></h1> 
<div>
  <table class="table table-striped">
    <tr>
      <td class="header" style="width:30%"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_ID'); ?>
        : </td>
      <td><?php echo $this->item->id; ?></td>
      <td style="width:15%">&nbsp;</td>
    </tr>
    <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_TITLE'); ?>
        :
      </td>
      <td>
      <div 
      class = "edit" 
      id="title" 
      data-type="text" 
      data-pk="<?php echo $this->item->id; ?>" 
      data-url="<?php echo JRoute::_('index.php?option=com_confmgt&task=paperform.save_ajax&tmpl=component&format=raw'); ?>" 
      data-title="Enter Title" 
      data-name = "title">
	  <?php echo $this->item->title; ?>
      </div>
      </td>
      <td><button class="btn edit_title" type="submit"><i class="icon-edit"></i></button></td> 
    </tr>
     <tr>
      <td class="header"><?php
		echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_CREATED_BY'); ?>
        :</td>
      <td><?php echo $this->item->created_by; ?></td>
      <td style="width:15%">&nbsp;</td>
    </tr>
  </table>
</div>
</div>