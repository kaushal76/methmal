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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('bootstrap.modal');
JHtml::_('bootstrap.alert', 'error');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
$document = JFactory::getDocument();
$url = 'components/com_confmgt/assets/js/jquery_custom.js';
$document->addScript($url);
?>
<?php
if (!$this->item->full_review_outcome == 0) { ?>
<div class="alert alert-block alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4 class="alert-heading"><?php echo JText::_('Review results have been posted to the authors'); ?> </h4>
  <p><?php echo JText::_('Review results for this paper have already been posted to the authors. You can view the posted review results under the "Paper details" tab.'); ?> </p>
</div>
<?php
}

if (!$this->rev1ews) { ?>
<div class="alert alert-block alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4 class="alert-heading"><?php echo JText::_('No reviews received yet'); ?> </h4>
  <p><?php echo JText::_('No reviews received from the assigned reviewers for this paper yet. However, you may post a review result to the author by inserting your own comments '); ?> </p>
</div>
<?php
}

?>
<div>
  <ul class="nav nav-tabs"  id="tabs">
    <?php if ($this->item->full_review_outcome == 0) { ?>
    <li><a href="#rev1ew_form" data-toggle="tab"> <?php echo JText::_('Post the Review Results'); ?> </a></li>
    <?php } ?>
    <li><a href="#paper" data-toggle="tab"> <?php echo JText::_('Paper Details'); ?> </a></li>
    <li><a href="#reviews" data-toggle="tab"> <?php echo JText::_('Reviews Received'); ?> </a></li>
    <li><a href="#reviewers" data-toggle="tab"> <?php echo JText::_('Reviewers Assigned'); ?> </a></li>
    <li><a href="#authors" data-toggle="tab"> <?php echo JText::_('Authors Details'); ?> </a></li>
  </ul>
  <div class="tab-content">
    <?php if ($this->item->full_review_outcome == 0) { ?>
    <div id="rev1ew_form" class="tab-pane fade">
      <?php
	  		echo $this->loadTemplate('fullpaper');
            echo $this->loadTemplate('form');
			?>
    </div>
    <?php } ?>
    <?php
$canView = $this->isThemeleader;
$canEdit = $this->isThemeleader;

if ($canView): 
	if ($this->item): ?>
    <div id="reviewers" class="tab-pane fade"> <?php echo $this->loadTemplate('rev1ewers'); ?> </div>
    <div id="authors" class="tab-pane fade"> <?php echo $this->loadTemplate('authors'); ?> </div>
    <div id="paper" class="tab-pane fade"> 
	<?php 
	if ($this->item->abstract_review_outcome > 0) { 
		echo $this->loadTemplate('abstract'); 
	}
	echo $this->loadTemplate('paper'); ?> 
    </div>
    <div id="reviews" class="tab-pane fade"> <?php echo $this->loadTemplate('rev1ews'); ?> </div>
    <form id="form-paper-list-<?php
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
</div>
<noscript>
<?php 
echo $this->loadTemplate('noscript');
?>
</noscript>