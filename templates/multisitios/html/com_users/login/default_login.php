<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

?>
<div class="uk-padding uk-container uk-container-xsmall">

	<div class="login<?php echo $this->pageclass_sfx; ?>">

		<?php if ($this->params->get('show_page_heading')) : ?>
			<div class="page-header">
				<h2 tabindex="0">
					<?php echo $this->escape($this->params->get('page_heading')); ?>
				</h2>
			</div>
		<?php endif; ?>
		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
			<div class="login-description">
		<?php endif; ?>
		<?php if ($this->params->get('logindescription_show') == 1) : ?>
			<?php echo $this->params->get('login_description'); ?>
		<?php endif; ?>
		<?php if ($this->params->get('login_image') != '') : ?>
			<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>" />
		<?php endif; ?>
		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
			</div>
		<?php endif; ?>
		<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal well uk-padding uk-width-1-2@s uk-width-1-1 uk-margin-auto">
				<?php echo $this->form->renderFieldset('credentials'); ?>
				<?php if ($this->tfa) : ?>
					<?php echo $this->form->renderField('secretkey'); ?>
				<?php endif; ?>

				<div class="control-group uk-margin">
					<div class="controls">
						<button type="submit" class="uk-button btn uk-button bgc-rojo-2 c-white">
							<?php echo JText::_('JLOGIN'); ?>
						</button>
					</div>
				</div>
				<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
				<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
				<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>

</div>
