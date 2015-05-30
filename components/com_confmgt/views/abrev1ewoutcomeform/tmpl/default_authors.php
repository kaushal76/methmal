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
		echo JText::_('COM_CONFMGT_PAPER_AUTHOR_PANEL_HEADING') . ' - ' . JText::_('Paper ID') . $this->item->id; ?>
    </h1>
  </div>
  <div class="panel-body">
    <div align="right"> </div>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="5%"><?php echo JText::_('#'); ?></th>
        <th width="95%"><?php echo JText::_('COM_CONFMGT_FORM_LBL_PAPER_AUTHORS'); ?></th>
      </tr>
    </thead>
    <tbody>
      	<?php
		if ($this->authors)
		{
			$i=1;
    	foreach($this->authors as $author)
			{
		?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $author->title . ' ' . $author->firstname . ' ' . $author->surname; ?></td>
      </tr>
      <?php 	$i=$i+1;
	  		
			}
		}
	?>
    </tbody>
  </table>
</div>
