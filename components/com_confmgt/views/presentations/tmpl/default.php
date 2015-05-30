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
            document.getElementById('form-presentation-delete-' + item_id).submit();
        }
    }
</script>
<?php 

$show = false; 
$linkid = $this->linkid;

?>
<div class="panel panel-default">
 <div class="panel-heading"><h1><?php echo JText::_('COM_CONFMGT_PRESENTATIONS_FORM_PANEL_HEADING'); echo $linkid; ?></h1></div>
  	<div class="panel-body">
    <p><?php echo sprintf(JText::_('COM_CONFMGT_PRESENTATIONS_FORM_PANEL_DETAILS'),$linkid); ?></p>
  	</div>
<table class="table">
<thead>
<tr>
<th><?php echo JText::_("COM_CONFMGT_PRESENTATIONS_NUMBER"); ?></th>
<th><?php echo JText::_("COM_CONFMGT_PRESENTATIONS_FILE"); ?></th>
<th><?php echo JText::_("COM_CONFMGT_PRESENTATIONS_TYPE"); ?></th>
<th><?php echo JText::_("COM_CONFMGT_ACTION"); ?></th>
</tr>
</thead>
<tbody>


        <?php foreach ($this->items as $item) : ?>
				<?php //TO-DO change the default ACL to confmgt ACL 
						$show = true;
						?>
                        <tr>
                        	<td width="5%">
							<?php echo $item->id; ?>
                            </td>
                            <td width="65%">
							<a href="<?php echo JRoute::_('index.php?option=com_confmgt&view=presentation&id=' . (int)$item->id); ?>"><?php echo $item->presentation; ?></a>
                            </td>
                            <td width="10%">
							<?php echo $item->type; ?>
                             </td>
                             <td width="20%">
                             		<?php	
									//TO-DO Change to confmgt ACL
									//if(JFactory::getUser()->authorise('core.delete','com_confmgt')):
									?>
										<form id="form-presentation-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&task=presentation.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
                                        <button class="btn btn-danger" onclick="javascript:deleteItem(<?php echo $item->id; ?>);"><?php echo '<span class="glyphicon glyphicon-trash"></span>';  ?></button>
                                       		<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="option" value="com_confmgt" />
											<input type="hidden" name="task" value="presentation.remove" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									//endif;
								?>
							</td>
                           </tr>
						

		<?php endforeach; ?>

</tbody>

        <?php
        if (!$show){ ?>
        <tr>
        <td colspan="4">
        <?php 
            echo JText::_('COM_CONFMGT_NO_ITEMS');
		?>
        </td>
        </tr>
        <?php
			$newBtn = JText::_("COM_CONFMGT_ADD_PRESENTATION");
			$nxtBtnDisable = " disabled = disabled";
		}else{
			$newBtn = JText::_("COM_CONFMGT_ADD_ANOTHER_PRESENTATION");
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
</div>
<div>
<?php 
 //TO-DO change the default ACL to confmgt ACL 
//if(JFactory::getUser()->authorise('core.create','com_confmgt')): ?>

<form id="form-presentation-new" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=paper&id='.$linkid); ?>" method="post" class="form-validate" enctype="multipart/form-data">
<?php echo JHtml::_('form.token'); ?>
<button class="btn btn-default btn-lg" type="submit"><?php echo JText::_("COM_CONFMGT_BACK_TO_PAPER"); ?> </button>
</form>

<form id="form-presentation-new" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=presentationform&linkid='.$linkid); ?>" method="post" class="form-validate" enctype="multipart/form-data">
<?php echo JHtml::_('form.token'); ?>
<input type="hidden" name="linkid" value="<?php echo $linkid; ?>" />
<button class="btn btn-default btn-lg" type="submit"><?php echo $newBtn; ?> </button>
</form>

<form id="form-presentation-list" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_confmgt&view=papers'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
<?php echo JHtml::_('form.token'); ?>
<button class="btn btn-default btn-lg" type="submit"><?php echo JText::_("COM_CONFMGT_PAPERS_BACK"); ?> </button>
</form>




<?php //endif; ?> 
</div>
