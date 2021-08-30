<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentError $this */

$document = JFactory::getDocument();
$app  = JFactory::getApplication();
$user = JFactory::getUser();
// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$format   = $app->input->getCmd('format', 'html');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

// Logo file or site title param
if ($params->get('logoFile'))
{$logo = '<img class="uk-width-5-6@xl uk-width-1@l uk-width-5-6@m uk-width-1-1@s uk-width-5-6@xs" src="' . JUri::root() . $params->get('logoFile') . '" alt="' . $sitename . '" />';}
elseif ($params->get('sitetitle'))
{$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';}
else{$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';}

$background_left = ($params->get('backgroundcolorLeft')) ? $params->get('backgroundcolorLeft') : '';
$background_right = ($params->get('backgroundcolorRight')) ? $params->get('backgroundcolorRight') : '';
$logo_main_cover = ($params->get('logoFileCover')) ? JUri::root().$params->get('logoFileCover') : '';
$logo_movil_main_cover = ($params->get('logoMovilFileCover')) ? JUri::root().$params->get('logoMovilFileCover') : $logo_main_cover;
$logo_main_cover_left = ($params->get('logoFileCoverLeft')) ? JUri::root().$params->get('logoFileCoverLeft') : '';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/uikit-3.7.1/css/uikit.min.css" rel="stylesheet" />
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" rel="stylesheet" />
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/app.css" rel="stylesheet" />
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/error.css" rel="stylesheet" />
	<?php if ($app->get('debug_lang', '0') == '1' || $app->get('debug', '0') == '1') : ?>
		<link href="<?php echo JUri::root(true); ?>/media/cms/css/debug.css" rel="stylesheet" />
	<?php endif; ?>
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/uikit-3.7.1/js/uikit.min.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/app.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
	<style>
		.left-header {
			background-color: <?php echo $background_left?>;
			background: <?php echo $background_left; ?> url(<?php echo $logo_main_cover_left; ?>) no-repeat right;
		}

		.right-header { background-color: <?php echo $background_right;?>; }

		.header-container {
			background-color:  <?php echo $background_right; ?>;
			background: <?php echo $background_right; ?> url(<?php echo $logo_movil_main_cover ?>) left/cover no-repeat;
		}

		/* XS UIKIT */
		@media (min-width:320px) { }
		/* S UIKIT */
		@media (min-width:640px) {
			.header-container { background: <?php echo $background_right; ?> url(<?php echo $logo_main_cover; ?>) left/cover no-repeat; }
		}
		/* M UIKIT */
		@media (min-width:960px) { }
		/* L UIKIT */
		@media (min-width:1200px) { }
		/* XL UIKIT */
		@media (min-width:1600px) { }
	</style>
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '')
	. ($this->direction === 'rtl' ? ' rtl' : '');
?>">
	<!-- Body -->
	<div class="body uk-height-1-1">
		<header class="header uk-position-relative">

			<div class="left-header" aria-hidden="true"></div>
			<div class="right-header" aria-hidden="true"></div>

			<div class="uk-container header-container">
				<div class="header-inner uk-grid-collapse" uk-grid>
					<div class="uk-width-1-2 uk-width-auto@m">
						<div class="uk-flex uk-flex-middle">
							<h1 class="uk-margin-remove">
								<a href="<?= $url ?>" tabindex="0" aria-label="Ir al inicio de <?= $sitename ?>">
								<?php echo $logo; ?>
								<?php if ($params->get('sitedescription')) : ?>
									<?php echo '<div class="site-description">' . htmlspecialchars($params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
								<?php endif; ?>
								</a>
							</h1>
						</div>
					</div>
				</div>
			</div>
		</header>
		<main id="main" class="uk-container uk-margin-large-top uk-flex uk-flex-middle content_error">
			<div>
				<!-- Header -->
				<div class="navigation">
					<?php // Display position-1 modules ?>
					<?php echo $this->getBuffer('modules', 'position-1', array('style' => 'none')); ?>
				</div>
				<!-- Banner -->
				<div class="banner">
					<?php echo $this->getBuffer('modules', 'banner', array('style' => 'xhtml')); ?>
				</div>
				<div class="uk-grid-match" uk-grid>
					<div class="uk-width-1-2@m uk-width-1-2@s uk-width-1-1@xs">
						<!-- Begin Content -->
						<h3 class="c-a8123d page-header uk-margin-remove"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h3>
						<div class="well">
							<div class="row-fluid">
								<div class="span6">
									<p>
										<strong>
											<?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?>
										</strong>
									</p>
									<p class="uk-visible@l uk-visible@m"><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
									<ul class="uk-visible@l uk-visible@m">
										<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
										<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
										<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
										<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
									</ul>
								</div>
							</div>
							<?php if ($this->debug) : ?>
								<div>
									<?php echo $this->renderBacktrace(); ?>
									<?php // Check if there are more Exceptions and render their data as well ?>
									<?php if ($this->error->getPrevious()) : ?>
										<?php $loop = true; ?>
										<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
										<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
										<?php $this->setError($this->_error->getPrevious()); ?>
										<?php while ($loop === true) : ?>
											<p><strong><?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
											<p>
												<?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
												<br/><?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->_error->getLine(); ?>
											</p>
											<?php echo $this->renderBacktrace(); ?>
											<?php $loop = $this->setError($this->_error->getPrevious()); ?>
										<?php endwhile; ?>
										<?php // Reset the main error object to the base error ?>

									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
						<!-- End Content -->
					</div>
					<div class="uk-width-1-2@m uk-width-1-2@s uk-width-1-1@xs uk-flex uk-flex-middle uk-flex-center">
						<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/error-corte.png" class="uk-width-4-5@m uk-width-3-5@s uk-width-2-5@xs">
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php echo $this->getBuffer('modules', 'debug', array('style' => 'none')); ?>
</body>
</html>
