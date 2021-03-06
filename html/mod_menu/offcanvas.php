<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$ABSOLUTE_PATH = dirname( __FILE__ );
$url = JURI::base() . str_replace( '\\', '/', str_replace( JPATH_ROOT . DIRECTORY_SEPARATOR, '', $ABSOLUTE_PATH ) . '/' ) ;
$doc = JFactory::getDocument();
$doc->addStyleSheet("{$url}css/offcanvas.css");

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use nav instead
?>
<ul class="uk-nav uk-nav-default uk-padding <?php echo $class_sfx; ?> uk-list-divider mod-list offcanvas"<?php echo $id; ?> role="navigation" aria-label="Menú principal">
<?php foreach ($list as $i => &$item)
{
	$class = 'item-' . $item->id;

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' uk-parent uk-active';
	}

	echo '<li class="' . $class . '" role="none">';

	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
			require JModuleHelper::getLayoutPath('mod_menu', 'offcanvas_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'offcanvas_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="nav-child unstyled small uk-nav-sub uk-list-divider" role="menu" aria-label="Submenú">';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?></ul>
