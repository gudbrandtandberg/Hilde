<?php
/**
 * @package Gantry Template Framework - RocketTheme
 * @version 1.2 April 25, 2012
 * @author RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

// load and inititialize gantry class
require_once('lib/gantry/gantry.php');
$gantry->init();

function isBrowserCapable(){
	global $gantry;
	
	$browser = $gantry->browser;
	
	// ie.
	if ($browser->name == 'ie' && $browser->version < 8) return false;
	
	return true;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
	<?php 
		$gantry->displayHead();
		$gantry->addStyles(array('template.css','joomla.css'));
		
		if ($gantry->browser->platform != 'iphone')
			$gantry->addInlineScript('window.addEvent("domready", function(){ new SmoothScroll(); });');
			
		if ($gantry->get('loadtransition') && isBrowserCapable()){
			$gantry->addScript('load-transition.js');
			$hidden = ' class="rt-hidden"';
		} else {
			$hidden = '';
		}
		
	?>
</head>
	<body <?php echo $gantry->displayBodyTag(array()); ?>>
		<div id="rt-page-surround">
			<?php /** Begin Background **/ if ($gantry->get('background-enabled')): ?>
			<div id="rt-bg-image">
				<div class="grad-bottom"></div>
				<div class="grad-left"></div>
				<div class="grad-right"></div>
			</div>
			<?php /** End Background **/ endif; ?>
			<div id="rt-page-surround-inner">
				<div id="rt-top-block">
					<div id="rt-top-surround" <?php echo $gantry->displayClassesByTag('rt-top-surround'); ?>><div id="rt-top-burst"><div id="rt-top-bottom">
						<?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
						<div id="rt-drawer">
							<div class="rt-container">
								<?php echo $gantry->displayModules('drawer','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php /** End Drawer **/ endif; ?>
						<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
						<div id="rt-top">
							<div class="rt-container">
								<?php echo $gantry->displayModules('top','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php /** End Top **/ endif; ?>
						<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
						<div id="rt-header">
							<?php if ($gantry->countModules('top')) : ?>
							<div class="rt-header-accent"><div class="rt-header-accent2">
							<?php endif; ?>
								<div class="rt-container">
									<?php echo $gantry->displayModules('header','standard','standard'); ?>
									<div class="clear"></div>
								</div>
							<?php if ($gantry->countModules('top')) : ?>
							</div></div>
							<?php endif; ?>
						</div>
						<?php /** End Header **/ endif; ?>
						<?php /** Begin Navigation **/ if ($gantry->countModules('navigation')) : ?>
						<div id="rt-navigation" class="<?php if ($gantry->get('menu-centering')) : ?>centered<?php endif; ?>">
							<div class="rt-container">
								<?php echo $gantry->displayModules('navigation','standard','menu'); ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php /** End Navigation **/ endif; ?>
					</div>
				</div></div></div>
				<?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
				<div id="rt-showcase" class="main-overlay">
					<div class="rt-container">
						<?php echo $gantry->displayModules('showcase','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Showcase **/ endif; ?>
				<?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
				<div class="rt-container">
					<div id="rt-feature">
						<div class="feature-top"><div class="feature-bottom"><div class="feature-accent">
							<?php echo $gantry->displayModules('feature','standard','standard'); ?>
							<div class="clear"></div>
						</div></div></div>
					</div>
				</div>
				<?php endif; ?>
				<div class="rt-container">
					<div id="rt-container-bg"<?php echo $hidden; ?>>
						<div id="rt-body-surround">
							<?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
							<div id="rt-utility" class="main-overlay">
								<?php echo $gantry->displayModules('utility','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Utility **/ endif; ?>
							<?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
							<div id="rt-maintop" class="rt-sidebar-surround main-overlay">
								<?php echo $gantry->displayModules('maintop','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Main Top **/ endif; ?>
							<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
							<div id="rt-breadcrumbs">
								<?php echo $gantry->displayModules('breadcrumb','basic','breadcrumbs'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Breadcrumbs **/ endif; ?>
							<?php /** Begin Main Body **/ ?>
						    <?php echo $gantry->displayMainbody('mainbody','sidebar','standard','standard','standard','standard','standard'); ?>
							<?php /** End Main Body **/ ?>
							<?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom')) : ?>
							<div id="rt-mainbottom" class="rt-sidebar-surround main-overlay">
								<?php echo $gantry->displayModules('mainbottom','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Main Bottom **/ endif; ?>
						</div>
					</div>
				</div>
				<?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
				<div class="rt-container">
					<div id="rt-bottom" <?php echo $gantry->displayClassesByTag('rt-bottom'); ?>>
						<div class="bottom-accent">
							<?php echo $gantry->displayModules('bottom','standard','standard'); ?>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<?php /** End Bottom **/ endif; ?>
			</div>
			<?php /** Begin Footer Section **/ if ($gantry->countModules('footer') or $gantry->countModules('copyright') or $gantry->countModules('debug')) : ?>
			<div id="rt-footer-surround" class="main-overlay">
				<?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>
				<div id="rt-footer">
					<div class="rt-container">
						<?php echo $gantry->displayModules('footer','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Footer **/ endif; ?>
				<?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
				<div id="rt-copyright">
					<div class="rt-container">
						<?php echo $gantry->displayModules('copyright','standard','limited'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Copyright **/ endif; ?>
				<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
				<div id="rt-debug">
					<div class="rt-container">
						<?php echo $gantry->displayModules('debug','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Debug **/ endif; ?>
			</div>
			<?php /** End Footer Section **/ endif; ?>
			<?php /** Begin Popups **/ 
			echo $gantry->displayModules('popup','popup','popup');
			echo $gantry->displayModules('login','login','popup'); 
			/** End Popup s**/ ?>
			<?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
			<?php echo $gantry->displayModules('analytics','basic','basic'); ?>
			<?php /** End Analytics **/ endif; ?>
		</div>
	</body>
</html>
<?php
$gantry->finalize();

?>