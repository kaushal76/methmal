<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

$archived	= $this->state->get('filter.published') == 2 ? true : false;
$trashed	= $this->state->get('filter.published') == -2 ? true : false;
?>


<h2><?php echo JText::_('COM_CONFMGR_PAPER_VIEW_PAPERS_TITLE'); ?></h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th width='10'%'>
					<?php echo JText::_('COM_CONFMGR_PAPER_FIELD_PAPER_ID_LABEL'); ?>
				</th>
			<th width='60%'>
					<?php echo JText::_('COM_CONFMGR_PAPER_FIELD_TITLE_LABEL'); ?>
				</th>
			<th width = '10%'>
					<?php echo JText::_('COM_CONFMGR_PAPER_FIELD_STUDENT_PAPER_LABEL'); ?>
				</th>
			<th width = '20%'>
					<?php echo JText::_('COM_CONFMGR_ACTION'); ?>
				</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->items as $i => $item) :?>
			<tr>
			<td><a
				href="<?php echo JRoute::_("index.php?option=com_confmgr&view=paper&id=" . $item->id); ?>">
							<?php echo $this->escape($item->id); ?>
						</a>
					<?php if ($item->published == 0) : ?>
						<span class="list-published label label-warning">
							<?php echo JText::_('JUNPUBLISHED'); ?>
						</span>
					<?php endif; ?>
				</td>
			<td><?php echo $this->escape($item->title); ?></td>
			<td><?php echo $this->escape($item->student_paper); ?></td>
			<td><a
				href="<?php echo JRoute::_("index.php?option=com_confmgr&task=paper.edit&id=" . $item->id); ?>"><i
					class="icon-edit"></i> <?php echo JText::_("JGLOBAL_EDIT"); ?></a>
			</td>
		</tr>
		<?php endforeach ?>
		</tbody>
	<tfoot>
		<tr>
			<td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td>
		</tr>
	</tfoot>
</table>

<div class="inline">
  <form id="form-entrypage-<?php echo $item->id ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit">
    <i class="icon-home"></i>
	<?php echo JText::_("COM_CONFMGR_HOME"); ?>
    </button>
    <input type="hidden" name="option" value="com_confmgr" />
    <input type="hidden" name="view" value="entrypage" />
  </form>
 </div>
 <div class="inline">
  <form id="form-paper-new-<?php echo $item->id ?>" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-entry" enctype="multipart/form-data">
    <?php echo JHtml::_('form.token'); ?>
    <button class="btn btn-default btn-lg" type="submit">
    <i class="icon-plus"></i>
	<?php echo JText::_("COM_CONFMGR_VIEW_PAPERS_ADD_PAPER"); ?>
    </button>
    <input type="hidden" name="option" value="com_confmgr" />
    <input type="hidden" name="task" value="papers.newabstract" />
  </form>
</div>

