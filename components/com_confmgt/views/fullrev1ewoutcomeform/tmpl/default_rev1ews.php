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
		echo JText::_('COM_CONFMGT_PAPER_REVIEWER_PANEL_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
      </h1>
    </div>
    <div class="panel-body">
      <div align="right"> </div>
    </div>
    <?php 
  if ($this->rev1ews)
  { ?>
    <table class="table table-striped">
    <thead>
      <tr>
        <th width="5%" class="header"><?php echo JText::_('#'); ?></td>
        <th class="header"><?php echo JText::_('Posted by'); ?></td>
        <th class="header"><?php echo JText::_('Recommendation'); ?></td>
        <th class="header"><?php echo JText::_('Comments to Author'); ?></td>
        <th class="header"><?php echo JText::_('Confidential Comments'); ?></td>
        <th class="header"><?php echo JText::_('Score'); ?></td>
      </tr>
     </thead>
      <tr>
        <?php
  $i=1;
  foreach($this->rev1ews as $rev1ew)
  { ?>
        <td><?php
		echo $i; ?>
          :</td>
        <td><?php

				echo JFactory::getUser($rev1ew->created_by)->name; 
		  ?></td>
          <td><?php
				echo JText::_ ('CONFMGT_ABSTRACT_REVIEWER_RECOMMENDATION_'.$rev1ew->recommendation);
		  ?></td>
        <td><?php
				echo nl2br ( $rev1ew->author_comments);
		  ?></td>
        <td><?php
				echo nl2br ( $rev1ew->leader_comments);
		  ?></td>
        <td><?php
				echo ( $rev1ew->score);
		  ?></td>
      </tr>
      <?php $i = $i+1;
  }  ?>
    </table>
    <?php } ?>
  </div>
