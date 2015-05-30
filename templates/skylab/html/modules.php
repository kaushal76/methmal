<?php

defined('_JEXEC') or die; 

function modChrome_rest($module, &$params, &$attribs)

{

	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;

	if (!empty ($module->content)) : ?>

	<div class="moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>"> 

		<?php if ($module->showtitle != 0) : ?>	      

		<h<?php echo $headerLevel; ?> class="module-title"><?php echo $module->title; ?></h<?php echo $headerLevel; ?>>

		<?php endif; ?>

		<div class="res">

	    <div class="module-content">

	        <?php echo $module->content; ?>

        </div>

        </div></div>

	<?php endif;    

}