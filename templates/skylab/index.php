<?php

/**

 * @subpackage        tpl_skylab

 * @copyright        Copyright (C) 2011 Linelab.org. All rights reserved.

 * @license          GNU General Public License version 3

 */

defined('_JEXEC') or die;

define( 'YOURBASEPATH', dirname(__FILE__) );

	JHtml::_('behavior.framework', true);

	$left_width = $this->params->get("leftWidth", "270");

	$right_width = $this->params->get("rightWidth", "270");

	$temp_width = $this->params->get("templateWidth", "960"); 

	$col_mode = "s-c-s";  

	if ($left_width==0 and $right_width>0) $col_mode = "x-c-s";

	if ($left_width>0 and $right_width==0) $col_mode = "s-c-x";

	if ($left_width==0 and $right_width==0) $col_mode = "x-c-x";

	$temp_width = 'margin: 0 auto; width: ' . $temp_width . 'px;';

	$slide	= $this->params->get('display_slideshow', 0);

	$slidecontent		= $this->params->get('slideshow', ''); 

	$sitetitle = $this->params->get("sitetitle", "Skylab - Super Clean Free Joomla 2.5 Template by LineLab.org");  

	?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

	<head>

	<?php

	require(YOURBASEPATH . DS . "tools.php");

	?>

	<jdoc:include type="head" /> 

	<link href="http://fonts.googleapis.com/css?family=Play" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/skylab/css/styles.css" type="text/css" media="screen,projection" />   

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 

	</head>

	<body>

<div class="tophorni"></div>

	<div id="main"> 

		<div id="wrapper">

		    <div id="header">

		            <div class="logo">	

	    	    <a href="index.php" id="logo" title="<?php echo $sitetitle ?>" ><img src="<?php echo $this->baseurl ?>/templates/skylab/images/logo.png" alt="" /></a>

		      </div>

	    	   <?php if ($this->countModules('top')) : ?> <div class="supertop"><jdoc:include type="modules" name="top" style="none"/><div class="clr"></div></div>     <?php endif; ?> 

	  	</div>

		<div id="navigace">     <a href="index.php" title="<?php echo $sitetitle ?>" ><div class="levy"><img src="<?php echo $this->baseurl ?>/templates/skylab/images/home.png" alt=""/></a></div>

			    <jdoc:include type="modules" name="position-1" style="none"/><?php if ($this->countModules('position-0')) : ?> <div class="supertop"><jdoc:include type="modules" name="position-0" style="none"/><div class="clr"></div></div>     <?php endif; ?> </div>

			<div id="message">

			    <jdoc:include type="message" />

			</div>

			<?php if ($this->countModules('position-12')) : ?> 

			<?php if ($slide == 1) { ?>

			<div class="obrazky">

			    <script type="text/javascript" src="templates/skylab/js/jquery.nivo.slider.pack.js"></script>

	<script type="text/javascript">

	var $j=jQuery.noConflict(); 

	 $j(window).load(function() {

    $j('#slider').nivoSlider({

        effect:'random', 

        slices:17,

        animSpeed:500,

        pauseTime:4000,

        startSlide:0,

        directionNav:true, 

        directionNavHide:false, 

        controlNav:true, 

        controlNavThumbs:false, 

        controlNavThumbsFromRel:false, 

        controlNavThumbsSearch: '.jpg', 

        controlNavThumbsReplace: '_thumb.jpg',

        keyboardNav:true, 

        pauseOnHover:true, 

        manualAdvance:false, 

        captionOpacity:0.7,

        beforeChange: function(){},

        afterChange: function(){},

        slideshowEnd: function(){} 

    });

});

	</script> 

          <div id="slider">

	<jdoc:include type="modules" name="position-12" style="none"/>

          </div></div>

			    		<?php } else { ?>

			      		<div class="obrazky"><div class="slida"><img src="<?php echo $this->baseurl ?>/<?php echo $slidecontent; ?>" alt=""/></div> </div> 

			<?php } ?> 

	    <?php endif; ?>  		<?php if ($this->countModules('position-3 or position-4 or position-5')) : ?>

			<div id="main2" class="spacer2<?php echo $main2_width; ?>">

				<jdoc:include type="modules" name="position-3" style="xhtml"/>

				<jdoc:include type="modules" name="position-4" style="xhtml"/>

				<jdoc:include type="modules" name="position-5" style="xhtml"/>

				</div>    	

				<?php endif; ?>

	        <div id="main-content" class="<?php echo $col_mode; ?>">

	            <div id="colmask">

	                <div id="colmid">

	                    <div id="colright">

	                        <div id="col1wrap">

								<div id="col1pad">

	                            	<div id="col1">

										<?php if ($this->countModules('position-2')) : ?>

										<?php endif; ?>

	<?php  if ($frontpage != 1) {

	 if ($menu->getActive() !== $menu->getDefault()) { ?>

	<div class="component"><div class="breadcrumbs-pad">

	                                        <jdoc:include type="modules" name="position-2" />

	                                    </div><div id="component"><jdoc:include type="component" /></div></div>

	             <?php }

	                  } else {

	                         ?> 

	<div class="component"><div class="breadcrumbs-pad">

	                                        <jdoc:include type="modules" name="position-2" />

	                                    </div><div id="component"><jdoc:include type="component" /></div></div>

	                 <?php 

	                     }

	                    ?>

										<?php if ($this->countModules('position-8')) : ?>

										<div class="spacer" id="stred">

											<jdoc:include type="modules" name="position-8" style="xhtml"/>

										</div>

										<?php endif; ?>

		                            </div>

								</div>

	                        </div>

							<?php if ($left_width != 0) : ?>

	                        <div id="col2">

	                        	<jdoc:include type="modules" name="position-7" style="rest"/>

	                        </div>

							<?php endif; ?>

							<?php if ($right_width != 0) : ?>

	                        <div id="col3">

	                        	<jdoc:include type="modules" name="position-6" style="rest"/>

	                        </div>

							<?php endif; ?>

	                    </div>

	                </div>

	            </div>

	        <?php if ($this->countModules('position-9 or position-10 or position-11')) : ?>

			<div id="main3" class="spacer<?php echo $main3_width; ?>">

				<jdoc:include type="modules" name="position-9" style="xhtml"/>

				<jdoc:include type="modules" name="position-10" style="xhtml"/>

				<jdoc:include type="modules" name="position-11" style="xhtml"/>

	</div>

				<?php endif; ?>  	

	        </div>	

		  </div>  <div id="footer">

			<jdoc:include type="modules" name="footerload" style="none" />

			<div class="copy">

			Copyright&nbsp;&copy; <?php echo date( '2010 - Y' ); ?> <?php echo $sitetitle; ?>. <a href="http://www.linelab.org" title="virtuemart templates">Linelab.org</a>

	    </div>

	    <div id="debug">

		<jdoc:include type="modules" name="debug" style="none" />

		</div>

	</div>

							</div> 

	   </body>

	  </html>

