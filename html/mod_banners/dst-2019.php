<?php
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
JLoader::register('BannerHelper', JPATH_ROOT . '/components/com_banners/helpers/banner.php');
$doc->addStyleSheet(JURI::base().'templates/dst_multisitios_2019/html/mod_banners/dst-2019.css');
?>
<div class="banners-slider" uk-slider>
    <div class="uk-position-relative">
        <div class="uk-slider-container uk-light">
  			<ul class="uk-slider-items uk-child-width-1-4@xl uk-child-width-1-4@l uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2@xs uk-grid">

<?php foreach ($list as $item) : ?>
	<li class="">
		<?php $link = JRoute::_('index.php?option=com_banners&task=click&id=' . $item->id); ?>
		<?php $imageurl = $item->params->get('imageurl'); ?>
		<?php $width = $item->params->get('width'); ?>
		<?php $height = $item->params->get('height'); ?>
		<?php if (BannerHelper::isImage($imageurl)) : ?>
			<?php // Image based banner ?>
			<?php $baseurl = strpos($imageurl, 'http') === 0 ? '' : JUri::base(); ?>
			<?php $alt = $item->params->get('alt'); ?>
			<?php $alt = $alt ?: $item->name; ?>
			<?php $alt = $alt ?: JText::_('MOD_BANNERS_BANNER'); ?>
			<?php if ($item->clickurl) : ?>
				<?php // Wrap the banner in a link ?>
				<?php $target = $params->get('target', 1); ?>
				<?php if ($target == 1) : ?>
					<?php // Open in a new window ?>
					<a
						href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer"
						title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
						<img
							src="<?php echo $baseurl . $imageurl; ?>"
							alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>"
							<?php if (!empty($width)) echo ' width="' . $width . '"';?>
							<?php if (!empty($height)) echo ' height="' . $height . '"';?>
						/>
					</a>
				<?php elseif ($target == 2) : ?>
					<?php // Open in a popup window ?>
					<a
						href="<?php echo $link; ?>" onclick="window.open(this.href, '',
							'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');
							return false"
						title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
						<img
							src="<?php echo $baseurl . $imageurl; ?>"
							alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>"
							<?php if (!empty($width)) echo ' width="' . $width . '"';?>
							<?php if (!empty($height)) echo ' height="' . $height . '"';?>
						/>
					</a>
				<?php else : ?>
					<?php // Open in parent window ?>
					<a
						href="<?php echo $link; ?>"
						title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
						<img
							src="<?php echo $baseurl . $imageurl; ?>"
							alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>"
							<?php if (!empty($width)) echo ' width="' . $width . '"';?>
							<?php if (!empty($height)) echo ' height="' . $height . '"';?>
						/>
					</a>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	</li>
<?php endforeach; ?>

</ul>

</div>
<div class="uk-hidden@s uk-light">
	<a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
	<a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
</div>
<div class="uk-visible@s">
	<a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
	<a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
</div>
</div>
<!-- <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul> -->
</div>