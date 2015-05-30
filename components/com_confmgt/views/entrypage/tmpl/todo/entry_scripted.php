<div id="scripted">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h1><?php echo JText::sprintf('COM_CONFMGT_ENTRY_FORM_PANEL_HEADING', $this->sitename); ?></h1>
    </div>
    <div class="panel-body">
      <p><?php echo JText::_('COM_CONFMGT_ENRTY_LAYOUT_PANEL_DETAILS'); ?></p>
      <div align="center"> <span>
        <button data-toggle="modal" class="btn btn-large btn-default" type="button" data-target="#modal" data-remote="<?php echo JRoute::_('index.php?option=com_confmgt&view=loginform&layout=modal&tmpl=component'); ?>"><?php echo JText::_("Login"); ?> </button>
        </span> <span>
        <button class="btn btn-large btn-default" type="button" data-target="#modal" data-toggle="modal" data-remote="<?php echo JRoute::_('index.php?option=com_confmgt&view=regform&layout=modal&tmpl=component'); ?>"><?php echo JText::_("Create an account"); ?> </button>
        </span> </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="loginModalLabel"><?php echo JText::_('Enter details'); ?></h4>
      </div>
      <div class="modal-body">
      </div>    
    </div>
  </div>
</div>