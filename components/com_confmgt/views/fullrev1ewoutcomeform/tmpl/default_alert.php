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

if (!$this->item->abstract_review_outcome == '') { ?>

<div class="alert alert-block alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4 class="alert-heading"><?php echo JText::_('Review results have been posted to the authors'); ?> </h4>
  <p><?php echo JText::_('Review results for this paper have already been posted to the authors. You can view the posted review results under the "Paper details" tab.'); ?> </p>
</div>
<?php
}

if (!$this->rev1ews) { ?>
<div class="alert alert-block alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4 class="alert-heading"><?php echo JText::_('No reviews received yet'); ?> </h4>
  <p><?php echo JText::_('No reviews received from the assigned reviewers for this paper yet. However, you may post a review result to the author by inserting your own comments '); ?> </p>
</div>
<?php
}
