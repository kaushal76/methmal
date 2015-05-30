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
JHtml::_('behavior.tooltip');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
JHtml::_('jquery.ui');


?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_CONFMGT_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-author-delete-' + item_id).submit();
        }
    }
</script>

<?php 

$show = false; 
$linkid = $this->linkid;

$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$saveOrder	= true;

?>
<div>
<form action="<?php echo JRoute::_('index.php?option=com_confmgt&view=authors'); ?>" method="post" name="adminForm" id="adminForm" style="display:inline">
<div class="panel panel-default">
 <div class="panel-heading"><h1><?php echo JText::_('COM_CONFMGT_AUTHORS_REORDER_FORM_PANEL_HEADING'); ?></h1></div>
  	<div class="panel-body">
    <p><?php echo JText::_('COM_CONFMGT_AUTHORS_REORDER_FORM_PANEL_DETAILS'); ?></p>
  	</div>


<table class="admintable table table-striped">
<thead>
<tr>
<th width="5%"><?php echo JText::_("#"); ?></th>
<th><?php echo JText::_("COM_CONFMGT_NAME"); ?></th>
</tr>
</thead>
<tbody>

        <?php foreach ($this->items as $i => $item) : ?>
        <?php $ordering	= true; ?>
				<?php //TO-DO change the default ACL to confmgt ACL 
						$show = true;
						?>
                        <tr>
                        	<td class = "order"><div class="controls"><input type="hidden" id="cb<?php echo $i; ?> " name="cid[]" value="<?php echo $item->id; ?>" /><input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="input-block-level" /></div>
                            </td>
                            <td>
							<?php echo $item->title.' '.$item->firstname.' '.$item->surname; ?>
                            </td>                
                           </tr>
		<?php endforeach; ?>

</tbody>

        <?php
        if (!$show){ ?>
        <tr>
        <td colspan="2">
        <?php 
            echo JText::_('COM_CONFMGT_NO_ITEMS');
		?>
        </td>
        </tr>
        <?php
			$newBtn = JText::_("COM_CONFMGT_ADD_AUTHOR");
			$nxtBtnDisable = " disabled = disabled";
		}else{
			$newBtn = JText::_("COM_CONFMGT_ADD_ANOTHER_AUTHOR");
			$nxtBtnDisable = "";
        }
        ?>
<tfoot>

<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>
</tfoot>
</table>
<div>
		<input type="hidden" name="task" value="authors.saveorder" />
		<input type="hidden" name="boxchecked" value="0" />
</div>
</div>

<?php 
 //TO-DO change the default ACL to confmgt ACL 
//if(JFactory::getUser()->authorise('core.create','com_confmgt')): ?>

<button class="btn btn-default btn-lg" type="submit">
<i class="icon-hdd"></i>
<?php echo 'Save authors sequence'; ?> 
</button>
</form>	
<form id="form-author-new" style="display:inline" 
action="<?php echo JRoute::_('index.php?option=com_confmgt&view=paper&id='.$linkid); ?>" 
method="post" class="form-validate" enctype="multipart/form-data">
<?php echo JHtml::_('form.token'); ?>
<button class="btn btn-default btn-lg" <?php echo $nxtBtnDisable; ?> type="submit">
<i class="icon-check"></i>
<?php echo JText::_("Done"); ?>
</button>
</form>
</div>

<?php //endif; ?> 

