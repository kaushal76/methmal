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

<div id="nonscripted">
  <?php if ($this->item->abstract_review_outcome == '') { 
  			echo $this->loadTemplate('formnoscript');
   }
$canView = $this->isThemeleader;
$canEdit = $this->isThemeleader;

if ($canView): 
	if ($this->item):
    	echo $this->loadTemplate('rev1ewers');
		echo $this->loadTemplate('authors');
		echo $this->loadTemplate('abstract'); 
		echo $this->loadTemplate('paper');
		echo $this->loadTemplate('rev1ews');
	?>
  <form id="form-paper-list-noscript<?php
		echo $this->item->id ?>" style="display:inline" action="<?php
		echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
    <?php
		echo JHtml::_('form.token'); ?>
    <input type="hidden" name="option" value="com_confmgt" />
    <input type="hidden" name="view" value="papers" />
    <input type="hidden" name="layout" value="leader_default" />
    <button class="btn btn-default" type="submit">
    <?php
		echo JText::_("<< Back"); ?>
    </button>
  </form>
  <?php
	else:
?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <?php
		echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_HEADING'); ?>
    </div>
    <div class="panel-body"> </div>
  </div>
  <?php
	endif;
else:
?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <?php
	echo JText::_('COM_CONFMGT_PAPER_FORM_PANEL_NOT_AUTHORISED'); ?>
    </div>
    <div class="panel-body"> </div>
  </div>
  <?php
endif;
?>
</div>
