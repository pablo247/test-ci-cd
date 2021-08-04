<?php
/**
 * @version    2.10.x
 *
 * @author     JoomlaWorks https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2020 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>

<div id="k2ModuleBox<?php echo $module->id; ?>"
    class="k2ItemsBlock<?php if ($params->get('moduleclass_sfx')) { echo ' '.$params->get('moduleclass_sfx'); } ?>">
    <?php if ($params->get('itemPreText')): ?>
    <p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
    <?php endif; ?>

    <?php if (isset($items) && count($items)): ?>
    <div class="uk-grid-small uk-grid-match uk-flex-center" uk-grid>
        <?php foreach ($items as $key => $item): ?>
        <div class="uk-width-1-5@l uk-width-1-3@m uk-width-1-2@s uk-width-1-1">
		<div class="b-solid-1 bc-gris-1 uk-padding-small uk-text-center" style="margin-top:50px">
            <!-- Plugins: BeforeDisplay -->
            <?php echo $item->event->BeforeDisplay; ?>

            <!-- K2 Plugins: K2BeforeDisplay -->
            <?php echo $item->event->K2BeforeDisplay; ?>

            <?php if ($params->get('itemAuthorAvatar')): ?>
            <a class="k2Avatar moduleItemAuthorAvatar" rel="author" href="<?php echo $item->authorLink; ?>">
                <img src="<?php echo $item->authorAvatar; ?>"
                    alt="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>"
                    style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
            </a>
            <?php endif; ?>

			<?php if ($params->get('itemImage') && !empty($item->image)): ?>
				<div class="uk-position-relative">
					<img class="uk-position-top-center" style="width: 70px;top:-50px;" src="<?php echo $item->image; ?>"
					alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" />
				</div>
			<?php endif; ?>

            <?php
            if($params->get('itemTitle')): ?>
                <h3 class="fs-18 c-rojo-2 uk-margin-remove-bottom" tabindex="0"><?php echo $item->title; ?></h3>
            <?php endif; ?>

            <?php if ($params->get('itemAuthor')): ?>
            <div class="moduleItemAuthor">
                <?php echo K2HelperUtilities::writtenBy($item->authorGender); ?>

                <?php if (isset($item->authorLink)): ?>
                <a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>"
                    href="<?php echo $item->authorLink; ?>">
                    <?php echo $item->author; ?>
                </a>
                <?php else: ?>
                <?php echo $item->author; ?>
                <?php endif; ?>

                <?php if ($params->get('userDescription')): ?>
                <?php echo $item->authorDescription; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Plugins: AfterDisplayTitle -->
            <?php echo $item->event->AfterDisplayTitle; ?>

            <!-- K2 Plugins: K2AfterDisplayTitle -->
            <?php echo $item->event->K2AfterDisplayTitle; ?>

            <!-- Plugins: BeforeDisplayContent -->
            <?php echo $item->event->BeforeDisplayContent; ?>

            <!-- K2 Plugins: K2BeforeDisplayContent -->
            <?php echo $item->event->K2BeforeDisplayContent; ?>

            <?php if ($params->get('itemIntroText')): ?>
            <div class="moduleItemIntrotext">
                <?php if ($params->get('itemIntroText')): ?>
                <?php echo $item->introtext; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if ($params->get('itemVideo') && !empty($item->video)): ?>
            <div class="moduleItemVideo">
                <?php echo $item->video; ?>
                <span class="moduleItemVideoCaption"><?php echo $item->video_caption; ?></span>
                <span class="moduleItemVideoCredits"><?php echo $item->video_credits; ?></span>
            </div>
            <?php endif; ?>

            <div class="clr"></div>

            <!-- Plugins: AfterDisplayContent -->
            <?php echo $item->event->AfterDisplayContent; ?>

            <!-- K2 Plugins: K2AfterDisplayContent -->
            <?php echo $item->event->K2AfterDisplayContent; ?>

            <?php if ($params->get('itemDateCreated')): ?>
            <span class="moduleItemDateCreated">
                <?php echo JText::_('K2_WRITTEN_ON'); ?>
                <?php echo JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC2')); ?>
            </span>
            <?php endif; ?>

            <?php if ($params->get('itemCategory')): ?>
            <?php echo JText::_('K2_IN'); ?> <a class="moduleItemCategory"
                href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a>
            <?php endif; ?>

            <?php if ($params->get('itemTags') && isset($item->tags) && count($item->tags) > 0): ?>
            <div class="moduleItemTags">
                <b><?php echo JText::_('K2_TAGS'); ?>:</b>
                <?php foreach ($item->tags as $tag): ?>
                <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($params->get('itemAttachments') && isset($item->attachments) && count($item->attachments)): ?>
            <div class="moduleAttachments">
                <?php foreach ($item->attachments as $attachment): ?>
                <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>"
                    href="<?php echo $attachment->link; ?>">
                    <?php echo $attachment->title; ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($params->get('itemCommentsCounter') && $componentParams->get('comments')): ?>
            <?php if (!empty($item->event->K2CommentsCounter)): ?>
            <!-- K2 Plugins: K2CommentsCounter -->
            <?php echo $item->event->K2CommentsCounter; ?>
            <?php else: ?>
            <?php if ($item->numOfComments > 0): ?>
            <a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
                <?php echo $item->numOfComments; ?>
                <?php if ($item->numOfComments > 1) {
                echo JText::_('K2_COMMENTS');
            } else {
                echo JText::_('K2_COMMENT');
            } ?>
            </a>
            <?php else: ?>
            <a class="moduleItemComments" href="<?php echo $item->link.'#itemCommentsAnchor'; ?>">
                <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
            </a>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>

            <?php if ($params->get('itemHits')): ?>
            <span class="moduleItemHits">
                <?php echo JText::_('K2_READ'); ?> <?php echo $item->hits; ?> <?php echo JText::_('K2_TIMES'); ?>
            </span>
            <?php endif; ?>

            <?php if ($params->get('itemReadMore') && $item->fulltext): ?>
            <a class="moduleItemReadMore" href="<?php echo $item->link; ?>">
                <?php echo JText::_('K2_READ_MORE'); ?>
            </a>
            <?php endif; ?>

            <!-- Plugins: AfterDisplay -->
            <?php echo $item->event->AfterDisplay; ?>

            <!-- K2 Plugins: K2AfterDisplay -->
            <?php echo $item->event->K2AfterDisplay; ?>

            <div class="clr"></div>
        </div>
		</div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($params->get('itemCustomLink')): ?>
    <a class="moduleCustomLink" href="<?php echo $itemCustomLinkURL; ?>"
        title="<?php echo K2HelperUtilities::cleanHtml($itemCustomLinkTitle); ?>">
        <?php echo $itemCustomLinkTitle; ?>
    </a>
    <?php endif; ?>

    <?php if ($params->get('feed')): ?>
    <div class="k2FeedIcon">
        <a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID='.$module->id); ?>"
            title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
            <i class="icon-feed"></i>
            <span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
        </a>
        <div class="clr"></div>
    </div>
    <?php endif; ?>
</div>