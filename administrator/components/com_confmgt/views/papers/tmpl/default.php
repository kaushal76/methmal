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
JHTML::_('script','system/multiselect.js',false,true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_confmgt/assets/css/confmgt.css');

$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_confmgt');
$saveOrder	= $listOrder == 'a.ordering';
?>

<form action="<?php echo JRoute::_('index.php?option=com_confmgt&view=papers'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('Search'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		
        
		<div class='filter-select fltrt'>
			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true);?>
			</select>
		</div>


	</fieldset>
	<div class="clr"> </div>

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
				</th>

				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_TITLE', 'a.title', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_ABSTRACT', 'a.abstract', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_KEYWORDS', 'a.keywords', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_CREATED_BY', 'a.created_by', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_FULL_PAPER', 'a.full_paper', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_CAMERA_READY', 'a.camera_ready', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_PRESENTATION', 'a.presentation', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_FULL_REVIEW_OUTCOME', 'a.full_review_outcome', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_ABSTRACT_REVIEW_OUTCOME', 'a.abstract_review_outcome', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_FULL_REVIEW_COMMENTS', 'a.full_review_comments', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_CONFMGT_PAPERS_ABSTRACT_REVIEW_COMMENTS', 'a.abstract_review_comments', $listDirn, $listOrder); ?>
				</th>


                <?php if (isset($this->items[0]->state)) { ?>
				<th width="5%">
					<?php echo JHtml::_('grid.sort',  'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
				</th>
                <?php } ?>
                <?php if (isset($this->items[0]->ordering)) { ?>
				<th width="10%">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
					<?php if ($canOrder && $saveOrder) :?>
						<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'papers.saveorder'); ?>
					<?php endif; ?>
				</th>
                <?php } ?>
                <?php if (isset($this->items[0]->id)) { ?>
                <th width="1%" class="nowrap">
                    <?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
                <?php } ?>
			</tr>
		</thead>
		<tfoot>
			<?php 
                if(isset($this->items[0])){
                    $colspan = count(get_object_vars($this->items[0]));
                }
                else{
                    $colspan = 10;
                }
            ?>
			<tr>
				<td colspan="<?php echo $colspan ?>">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$ordering	= ($listOrder == 'a.ordering');
			$canCreate	= $user->authorise('core.create',		'com_confmgt');
			$canEdit	= $user->authorise('core.edit',			'com_confmgt');
			$canCheckin	= $user->authorise('core.manage',		'com_confmgt');
			$canChange	= $user->authorise('core.edit.state',	'com_confmgt');
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>

				<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'papers.', $canCheckin); ?>
				<?php endif; ?>
				<?php if ($canEdit) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_confmgt&task=paper.edit&id='.(int) $item->id); ?>">
					<?php echo $this->escape($item->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($item->title); ?>
				<?php endif; ?>
				</td>
				<td>
					<?php echo $item->abstract; ?>
				</td>
				<td>
					<?php echo $item->keywords; ?>
				</td>
				<td>
					<?php echo $item->created_by; ?>
				</td>
				<td>

					<?php
						if (!empty($item->full_paper)):
							$uploadPath = 'components' . DIRECTORY_SEPARATOR . 'com_confmgt' . DIRECTORY_SEPARATOR . 'upload' .DIRECTORY_SEPARATOR . $item->full_paper;
							echo '<a href="' . JRoute::_(JUri::base() . $uploadPath, false) . '" target="_blank" title="See the full_paper">' . $item->full_paper . '</a>';
						else:
							echo $item->full_paper;
						endif; ?>				</td>
				<td>

					<?php
						if (!empty($item->camera_ready)):
							$uploadPath = 'components' . DIRECTORY_SEPARATOR . 'com_confmgt' . DIRECTORY_SEPARATOR . 'upload/camera' .DIRECTORY_SEPARATOR . $item->camera_ready;
							echo '<a href="' . JRoute::_(JUri::base() . $uploadPath, false) . '" target="_blank" title="See the camera_ready">' . $item->camera_ready . '</a>';
						else:
							echo $item->camera_ready;
						endif; ?>				</td>
				<td>

					<?php
						if (!empty($item->presentation)):
							$uploadPath = 'components' . DIRECTORY_SEPARATOR . 'com_confmgt' . DIRECTORY_SEPARATOR . 'upload/presentations' .DIRECTORY_SEPARATOR . $item->presentation;
							echo '<a href="' . JRoute::_(JUri::base() . $uploadPath, false) . '" target="_blank" title="See the presentation">' . $item->presentation . '</a>';
						else:
							echo $item->presentation;
						endif; ?>				</td>
				<td>
					<?php echo $item->full_review_outcome; ?>
				</td>
				<td>
					<?php echo $item->abstract_review_outcome; ?>
				</td>
				<td>
					<?php echo $item->full_review_comments; ?>
				</td>
				<td>
					<?php echo $item->abstract_review_comments; ?>
				</td>


                <?php if (isset($this->items[0]->state)) { ?>
				    <td class="center">
					    <?php echo JHtml::_('jgrid.published', $item->state, $i, 'papers.', $canChange, 'cb'); ?>
				    </td>
                <?php } ?>
                <?php if (isset($this->items[0]->ordering)) { ?>
				    <td class="order">
					    <?php if ($canChange) : ?>
						    <?php if ($saveOrder) :?>
							    <?php if ($listDirn == 'asc') : ?>
								    <span><?php echo $this->pagination->orderUpIcon($i, true, 'papers.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								    <span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'papers.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							    <?php elseif ($listDirn == 'desc') : ?>
								    <span><?php echo $this->pagination->orderUpIcon($i, true, 'papers.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								    <span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'papers.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							    <?php endif; ?>
						    <?php endif; ?>
						    <?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
						    <input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />
					    <?php else : ?>
						    <?php echo $item->ordering; ?>
					    <?php endif; ?>
				    </td>
                <?php } ?>
                <?php if (isset($this->items[0]->id)) { ?>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
                <?php } ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>