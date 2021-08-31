<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg. To render a module mod_test in the submenu style, you would use the following include:
 * <jdoc:include type="module" name="test" style="submenu" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a submenu
 */
function modChrome_no($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

function modChrome_wrap( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo '<div class="'.$attribs['name'].' '.$params->moduleclass_sfx.'">';
		if ($module->showtitle)
		{
			echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
		}
	echo $module->content;
	echo '</div>';
}

function modChrome_well($module, &$params, &$attribs)
{
	$moduleTag     = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize !== 0 ? ' span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="well ' . htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}

function modChrome_titular( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class='bgc-f1f1f1'>";
	echo "<div class='titular-border-bottom uk-container {$attribs['name']} {$params->moduleclass_sfx}'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
}

function modChrome_container_uikit( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class=' {$attribs['name']} {$params->moduleclass_sfx} uk-padding-large uk-padding-remove-left uk-padding-remove-right'>";
	echo "<div class='uk-container'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
}

function modChrome_container_uikit_margin_top( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class=' {$attribs['name']} {$params->moduleclass_sfx} uk-padding-large uk-padding-remove-left uk-padding-remove-right uk-padding-remove-bottom'>";
	echo "<div class='uk-container'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
}

function modChrome_container_uikit_margin_bottom( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class=' {$attribs['name']} {$params->moduleclass_sfx} uk-padding-large uk-padding-remove-left uk-padding-remove-right uk-padding-remove-top'>";
	echo "<div class='uk-container'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
}

function modChrome_container_uikit_margin_n_0_s_0( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class='{$attribs['name']} {$params->moduleclass_sfx} uk-padding-large uk-padding-remove-left uk-padding-remove-right uk-padding-remove-bottom'>";
	echo "<div class='uk-padding-small uk-padding-remove-left uk-padding-remove-right uk-padding-remove-top'>";
	echo "<div class='uk-container'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
	echo '</div>';
}

function modChrome_container_uikit_margin_s_0_n_0( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class='{$attribs['name']} {$params->moduleclass_sfx} uk-padding-large uk-padding-remove-left uk-padding-remove-right uk-padding-remove-top'>";
	echo "<div class='uk-padding-small uk-padding-remove-left uk-padding-remove-right uk-padding-remove-bottom'>";
	echo "<div class='uk-container'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
}

function modChrome_container_uikit_whitout_margin( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class='{$params->moduleclass_sfx}'>";
	echo "<div class='uk-container {$attribs['name']}'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
}

function modChrome_slider( $module, &$params, &$attribs ) {
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');
	$params=json_decode($module->params);
	echo "<div class='{$params->moduleclass_sfx}'>";
	echo "<div class='uk-padding-remove uk-container uk-container-xlarge {$attribs['name']}'>";
	if ($module->showtitle)
	{
		echo '<' . $headerTag . ' tabindex="0" class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
	}
	echo $module->content;
	echo '</div>';
	echo '</div>';
}
