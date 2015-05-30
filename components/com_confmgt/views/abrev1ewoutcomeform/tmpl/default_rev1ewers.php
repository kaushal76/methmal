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
    <?php
  if ($this->rev1ewers)
  { ?>
    <table class="table table-striped">
      <?php
  $i=1;
  foreach($this->rev1ewers as $rev1ewer)
  { ?>
      <tr>
        <td width="5%"><?php
		echo $i; ?>
          :</td>
        <td><?php

				echo ( $rev1ewer->revtitle . ' ' . $rev1ewer->revfirstname . ' ' . $rev1ewer->revsurname );  
		  ?></td>
      </tr>
      <?php $i = $i+1;
  }  ?>
    </table>
    <?php }else{ ?>
    <div>
      <?php 
  		echo JText::_('COM_CONFMGT_PAPER_REVIEWER_EMPTY'); 
  	  ?>
    </div>
    <?php } ?>
  </div>
</div>
