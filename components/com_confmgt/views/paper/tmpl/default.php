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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('bootstrap.modal');
JHtml::_('bootstrap.alert', 'error');

// Load admin language file

$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);

$document = JFactory::getDocument();
$document->addScript('components/com_confmgt/assets/js/jquery_custom.js');

//adding overriding styles
$url = "http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap-editable/css/bootstrap-editable.css";
$document = JFactory::getDocument();
$document->addStyleSheet($url);

$url = "http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap-editable/js/bootstrap-editable.min.js";
$document = JFactory::getDocument();
$document->addScript($url);
?>

<div id="scripted">
  <?php

$canView = $this->isAuthor;
$canEdit = $this->isAuthor;

if ($canView):
?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h1>
        <?php
		echo JText::_('Paper Status') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
      </h1>
    </div>
    <div class="panel-body">
      <div align="table">
        <?php
	if ($this->item): ?>
        <?php echo $this->loadTemplate('authors'); ?> <?php echo $this->loadTemplate('information'); ?> <?php echo $this->loadTemplate('paper'); ?> <?php echo $this->loadTemplate('rev1ew'); ?>
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
    </div>
  </div>
</div>
<div class="inline">
  <form id="form-entrypage-<?php echo $item->id ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
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
<form id="form-paper-list-<?php
		echo $this->item->id ?>" style="display:inline" action="<?php
		echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
  <?php
		echo JHtml::_('form.token'); ?>
  <input type="hidden" name="option" value="com_confmgt" />
  <input type="hidden" name="view" value="papers" />
  <button class="btn btn-default" type="submit">
  <i class="icon-list"></i>
  <?php echo JText::_("COM_CONFMGT_PAPERS_LIST"); ?>
  </button>
</form>
</div>

