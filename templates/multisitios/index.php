<?php
defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$document = JFactory::getDocument();
$app  = JFactory::getApplication();
$user = JFactory::getUser();

$this->setHtml5(true);

$params = $app->getTemplate(true)->params;
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$sitetitle = htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8');
$uri = JUri::getInstance();
$url = JURI::base();

JHtml::_('script', 'jquery-3.4.1.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));
JHtml::_('script', 'lozad.min.js', array('version' => 'auto', 'relative' => true));

JHtml::_('stylesheet', 'templates/'.$this->template.'/uikit-3.7.1/css/uikit.min.css');
JHtml::_('script', 'templates/'.$this->template.'/uikit-3.7.1/js/uikit.min.js');
JHtml::_('script', 'templates/'.$this->template.'/uikit-3.7.1/js/uikit-icons.min.js');

JHtml::_('stylesheet', 'template.css', array('relative' => true));
JHtml::_('script', 'template.js', array('relative' => true));

JHtml::_('stylesheet', 'app.css', array('relative' => true));
JHtml::_('script', 'app.js', array('relative' => true));

JHtml::_('stylesheet', 'media/templates/site/'.$this->template.'/css/user.css');
JHtml::_('script', 'media/templates/site/'.$this->template.'/js/user.js');

// Logo file or site title param
if ($this->params->get('logoFile')) {
	$logo = "<img class='uk-width-1-1' src='{$url}{$this->params->get('logoFile')}' alt='{$sitename}' />";
}
elseif ($this->params->get('sitetitle')) {
	$logo = "<span class='site-title' title='{$sitename}'>{$sitetitle}</span>";
}
else {
	$logo = "<span class='site-title' title='{$sitename}'>{$sitename}</span>";
}

$background_left = ($this->params->get('backgroundcolorLeft')) ? $this->params->get('backgroundcolorLeft') : '';
$background_right = ($this->params->get('backgroundcolorRight')) ? $this->params->get('backgroundcolorRight') : '';
$logo_main_cover = ($this->params->get('logoFileCover')) ? $url.$this->params->get('logoFileCover') : '';
$logo_movil_main_cover = ($this->params->get('logoMovilFileCover')) ? $url.$this->params->get('logoMovilFileCover') : $logo_main_cover;
$logo_main_cover_left = ($this->params->get('logoFileCoverLeft')) ? $url.$this->params->get('logoFileCoverLeft') : '';

$css = <<<CSS
	.left-header {
		background-color: $background_left;
		background: $background_left url($logo_main_cover_left) right/900px 100% no-repeat;
	}

	.header-container,
	.right-header
	{ background-color: $background_right; }

	.header-container {
		background: $background_right url($logo_movil_main_cover) left/auto 100% no-repeat;
		min-height: 150px;
	}
	/* S UIKIT */
	@media (min-width:640px) { }
	/* M UIKIT */
	@media (min-width:960px) {
		.header-container {
			background: $background_right url($logo_main_cover) left/cover no-repeat;
			min-height: 180px;
		}
	 }
	/* L UIKIT */
	@media (min-width:1200px) { }
	/* XL UIKIT */
	@media (min-width:1600px) { }
CSS;
$document->addStyleDeclaration($css);
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
</head>
<body>
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
							<?php if ($this->params->get('sitedescription')) : ?>
								<div class="site-description"><?=htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8')?></div>
							<?php endif; ?>
							</a>
						</h1>
					</div>
				</div>
				<div class="uk-width-expand">
					<div class="uk-flex uk-flex-bottom uk-flex-column uk-height-1-1">
						<?php if (
							$this->params->get('goToPuebla') ||
							$this->countModules('offcanvas') ||
							$this->params->get('facebook') ||
							$this->params->get('twitter') ||
							$this->params->get('youtube')
						):?>
						<div class="uk-margin-top uk-margin-small-bottom">
							<div uk-grid class="uk-grid-small uk-text-right">
								<div class="uk-width-1 uk-width-auto@m uk-flex uk-flex-middle uk-flex-right">
									<?php if($this->params->get('goToPuebla')) : ?>
										<a tabindex="0" href="<?= $this->params->get('goToPuebla') ?>" target="_blank" class="link--secondary uk-margin-left-small uk-padding-small uk-padding-remove-top uk-padding-remove-bottom" aria-label="Ir al portal del Gobierno del Estado de Puebla">
											<span aria-hidden="true" class="fs-12 fs-16@m">
												<?=$this->params->get('titleGoToPuebla')?>
											</span>
										</a>
									<?php endif; ?>
									<?php if ($this->countModules('offcanvas')) : ?>
										<button uk-toggle="target: #offcanvas-flip" data-offcanvas="offcanvas-flip" class="uk-button uk-hidden@m uk-margin-left-small uk-padding-small uk-padding-remove-top uk-padding-remove-bottom" tabindex="0" aria-label="Abrir menú" type="button" role="button" style="background-color: transparent;">
											<span class="c-a8123d" uk-icon="icon: menu; ratio: 1.3" aria-hidden="true"></span>
										</button>
									<?php endif; ?>
								</div>
								<div class="uk-width-1 uk-width-auto@m">
									<?php if ($this->params->get('facebook')) : ?>
										<a href="<?= $this->params->get('facebook') ?>" target="_blank" tabindex="0" aria-label="Ir al facebook de <?=$sitename?>" class="uk-margin-left-small uk-padding-small uk-padding-remove-top uk-padding-remove-bottom uk-visible1@m uk-link-reset">
											<i aria-hidden="true" class="fs-35 picon-icon_face"></i>
										</a>
									<?php endif; ?>
									<?php if ($this->params->get('twitter')) : ?>
										<a href="<?= $this->params->get('twitter') ?>" target="_blank" tabindex="0" aria-label="Ir al Twitter de <?=$sitename?>" class="uk-margin-left-small uk-padding-small uk-padding-remove-top uk-padding-remove-bottom uk-visible1@m uk-link-reset">
											<i aria-hidden="true" class="fs-35 picon-icon_tw"></i>
										</a>
									<?php endif; ?>
									<?php if ($this->params->get('youtube')) : ?>
										<a href="<?= $this->params->get('youtube') ?>" target="_blank" tabindex="0" aria-label="Youtube de la <?=$sitename?>">
											<i class="fs-27 picon-icon_youtube"></i>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>

						<?php if ($this->countModules('menu')) : ?>
						<div class="uk-margin-small-top uk-margin-small-bottom">
							<div class="uk-flex uk-flex-right uk-flex-middle uk-width-1-1 uk-visible@m">
								<div class="menu-container">
									<jdoc:include type="modules" name="menu" style="xhtml" />
								</div>
							</div>
						</div>
						<?php endif; ?>

						<?php if ($this->countModules('buscador')) : ?>
						<div>
							<div class="uk-flex uk-flex-right uk-flex-middle uk-width-1-1">
								<div class="buscador-container">
									<jdoc:include type="modules" name="buscador" style="xhtml" />
								</div>
							</div>
						</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
    	</div>
	</header>

	<main id="main" class="body" uk-height-viewport="expand: true">

		<?php if ($this->countModules('main-top')): ?>
			<jdoc:include type="modules" name="main-top" style="wrap" />
		<?php endif; ?>

		<?php if ($this->countModules('interior-top')): ?>
			<jdoc:include type="modules" name="interior-top" style="wrap" />
		<?php endif; ?>

		<?php if ($this->countModules('extra1-top')): ?>
			<jdoc:include type="modules" name="extra1-top" style="wrap" />
		<?php endif; ?>

		<?php if ($this->countModules('extra2-top')): ?>
			<jdoc:include type="modules" name="extra2-top" style="wrap" />
		<?php endif; ?>

		<div class="uk-container joomla-content">
			<jdoc:include type="component" />
		</div>

		<?php if ($this->countModules('main-bottom')): ?>
			<jdoc:include type="modules" name="main-bottom" style="wrap" />
		<?php endif; ?>

		<?php if ($this->countModules('interior-bottom')): ?>
			<jdoc:include type="modules" name="interior-bottom" style="wrap" />
		<?php endif; ?>

		<?php if ($this->countModules('extra1-bottom')): ?>
			<jdoc:include type="modules" name="extra1-bottom" style="wrap" />
		<?php endif; ?>

		<?php if ($this->countModules('extra2-bottom')): ?>
			<jdoc:include type="modules" name="extra2-bottom" style="wrap" />
		<?php endif; ?>

	</main>

	<div class="separador-rojo"></div>
	<footer class="footer bgc-negro-2">
		<div class="uk-container footer-container" style="min-height: 300px;">
			<div uk-grid>
				<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-3@s uk-width-1-1@xs uk-flex uk-flex-middle  uk-flex-center">
					<?php if ($this->countModules('footer-left')) : ?>
						<jdoc:include type="modules" name="footer-left" style="wrap" />
					<?php endif; ?>
				</div>
				<div class="uk-width-2-3@xl uk-width-2-3@l uk-width-2-3@m uk-width-2-3@s uk-width-1-1@xs">
					<?php if ($this->countModules('footer-right')) : ?>
						<jdoc:include type="modules" name="footer-right" style="wrap" />
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="footer-border bgc-3c4145"></div>
		<?php if ($this->countModules('copyright')) : ?>
		<div class="copyright-container bgc-eaeaed">
			<jdoc:include type="modules" name="copyright" style="wrap" />
		</div>
		<?php endif; ?>

	</footer>

	<jdoc:include type="modules" name="debug" style="none" />

	<?php if ($this->countModules('offcanvas')) : ?>
		<div id="offcanvas-flip" class="uk-hidden@m" uk-offcanvas="flip: true; overlay: true">
			<div class="uk-offcanvas-bar uk-padding-remove a11y__dialog-wrapper" tabindex="-1">
				<button class="uk-offcanvas-close" type="button" uk-close tabindex="-1" aria-hidden="true" aria-label="Cerrar menú"></button>
				<h3 tabindex="0"><?=$sitename?></h3>
				<jdoc:include type="modules" name="offcanvas" style="wrap" />
				<button class="uk-offcanvas-close" type="button" uk-close role="button" tabindex="0">
					<span class="accessibility--hidden">Cerrar Menú</span>
				</button>
			</div>
		</div>
    <?php endif; ?>

	<?php echo $this->params->get('googleAnalytics'); ?>
	<?php echo $this->params->get('accessibility'); ?>
</body>
</html>
