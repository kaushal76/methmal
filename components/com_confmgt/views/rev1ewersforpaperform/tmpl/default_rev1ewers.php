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
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_CONFMGT_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-rev-delete-' + item_id).submit();
        }
    }
</script>

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
      <thead>
        <tr>
          <th><?php echo JText::_('#'); ?> </th>
          <th><?php echo JText::_('Name'); ?> </th>
          <th><?php echo JText::_('Remove'); ?> </th> 
        </tr>
      </thead>
      <tbody>
        <?php
  $i=1;
  foreach($this->rev1ewers as $rev1ewer)
  { ?>
        <tr>
          <td width="5%"><?php
		echo $i; ?></td>
          <td width="90%"><?php
			echo ( $rev1ewer->revtitle . ' ' . $rev1ewer->revfirstname . ' ' . $rev1ewer->revsurname );  
		  ?></td>
          <td><form id="form-rev-delete-<?php echo $rev1ewer->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
              <button class="btn btn-danger" type="button" onclick="javascript:deleteItem(<?php echo $rev1ewer->id; ?>);"><i class="icon-trash icon-white"></i></button>
              <input type="hidden" name="jform[rev_id]" value="<?php echo $rev1ewer->id; ?>" />
              <input type="hidden" name="option" value="com_confmgt" />
              <input type="hidden" name="task" value="rev1ewersforpaperform.remove" />
              <?php echo JHtml::_('form.token'); ?>
            </form></td>
        </tr>
        <?php $i = $i+1;
  }  ?>
      </tbody>
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
