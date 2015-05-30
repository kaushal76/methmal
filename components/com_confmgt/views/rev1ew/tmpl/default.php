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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_confmgt', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_confmgt');
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_confmgt')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">

        <ul class="fields_list">

            

        </ul>

    </div>
    
<?php
else:
    echo JText::_('COM_CONFMGT_ITEM_NOT_LOADED');
endif;
?>
