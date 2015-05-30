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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
?>
<div class = 'panel panel-default'>
  <fieldset>
    <legend><?php echo JText::_('Full paper'); ?></legend>
      <table class="table table-striped">
      <tr>
      <th width="30%"> <?php echo JText::_('Full paper submitted:'); ?> </th>
      <td> <?php echo ($this->paper->full_paper); ?> </td>
      </tr>
      <tr>
      <th> <?php echo JText::_('Download:'); ?> </th>
      <td> <?php echo ($this->paper->full_paper_download); ?></td>
      </tr>
      </table>
  </fieldset>
</div>

<div class = 'panel panel-default'>
  <fieldset>
      <legend><?php echo JText::_('Full paper review details:'); ?></legend>
        <table class="table table-striped">
        <tr>
          <th width="30%"> <?php echo JText::_('Recommendation'); ?> </th>
          <td> <?php echo JText::_('CONFMGT_REVIEW_RECOMMENDATION_'.$this->item->recommendation); ?> </td>
          </tr>

        <tr>
          <th> <?php echo JText::_('Comments for author:'); ?> </th>
          <td> <?php echo $this->item->author_comments; ?> </td>
          </tr>
        <tr>
          <th> <?php echo JText::_('Comments for leader:'); ?> </th>
          <td> <?php echo $this->item->leader_comments; ?> </td>
        </tr>
        <tr>
          <th> <?php echo JText::_('score:'); ?> </th>
          <td> <?php echo $this->item->score; ?> </td>
        </tr>
        <tr>
        <td colspan="2"><a class = "btn btn-default" href="<?php echo JRoute::_('index.php?option=com_confmgt&task=rev1ewform.cancel'); ?>" title="<?php echo JText::_('OK'); ?>"><?php echo JText::_('OK'); ?></a></td>
        </tr>
        </table>
  </fieldset>
</div>