<?php
	defined('_JEXEC') or die;

	$ABSOLUTE_PATH = dirname( __FILE__ );
	$url = JURI::base() . str_replace( '\\', '/', str_replace( JPATH_ROOT . DIRECTORY_SEPARATOR, '', $ABSOLUTE_PATH ) . '/' ) ;
	$doc = JFactory::getDocument();
	// $doc->addStyleSheet($url.'css/style.css');
	// $doc->addScript($url.'js/script.js');
?>

<div uk-slideshow="autoplay: true; ratio: 7:2; pause-on-hover: true;">

    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

        <ul class="uk-slideshow-items">

			<?php foreach ($items as $item): ?>
				<?php $i_title = $item->title; ?>
				<?php $i_link = (isset($item->extraFields->Link)) ? $item->extraFields->Link->value : null; ?>
				<?php $i_image = $item->image; ?>

				<li class="slideshow-item" tabindex="-1">
					<?php if ($i_link): ?>
					<a href="<?=$i_link?>" target="_blank">
						<img alt="<?= $i_title ?>" src="<?=$i_image?>" width="100%" />
						<span tabindex="-1" class="a11y--hidden"><?= $i_title ?></span>
					</a>
					<?php else: ?>
					<img alt="<?= $i_title ?>" src="<?=$i_image?>" width="100%" />
					<span tabindex="-1" class="a11y--hidden"><?= $i_title ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
        </ul>

        <a class="uk-position-center-left uk-position-small uk-slidenav-large" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-slidenav-large" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

    </div>

    <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-small"></ul>

</div>
