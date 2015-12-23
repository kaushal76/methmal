<?php
/**
 * @author		Dr Kaushal Keraminiyage
 * @copyright	Dr Kaushal Keraminiyage
 * @license		GNU General Public License version 2 or later
 */

defined("_JEXEC") or die("Restricted access");

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.loadCss', 'true', 'ltr');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');

?>

<div class = 'form-horizontal well'>
  <fieldset>
    <div class="paper-edit front-end-edit">
      <legend><?php echo JText::_('COM_CONFMGR_VIEW_PAPER_EDIT_PAPER_ID:'); echo $this->item->id; ?></legend>

      <form id="form-paper" role="form" action="<?php echo JRoute::_('index.php?option=com_confmgr&task=paper.save'); ?> 
		" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('id'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('id'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('abstract_id'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('abstract_id'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('title'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('title'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('abstract'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('abstract'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('keywords'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('keywords'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('theme'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('theme'); ?> </div>
        </div>
         <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('student_paper'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('student_paper'); ?> </div>
        </div>
        <div class="control-group">
          <div class="control-label"> <?php echo $this->
				form->getLabel('created_by'); ?> </div>
          <div class="controls"> <?php echo $this->
				form->getInput('created_by'); ?> </div>
        </div>
        <div class="control-group">
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo JText::_('JSUBMIT'); ?> </button>
            <?php echo JText::_('or'); ?> <a href="<?php echo jroute::_('index.php?option=com_confmgr&task=paper.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>
				"><?php echo JText::_('JCANCEL'); ?> </a>
            <input type="hidden" name="option" value="com_confmgr"/>
            <input type="hidden" name="task" value="paper.save"/>
            <?php echo JHtml::_('form.token'); ?> </div>
        </div>
      </form>
    </div>
  </fieldset>
</div>
