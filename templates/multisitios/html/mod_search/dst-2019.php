<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline" role="search">
    <?php if ( ! empty( trim( $label ) ) ): ?>
    <label for="mod-search-searchword<?= $module->id ?>" class="element-invisible"><?= $label ?></label>
    <?php endif; ?>
    <div class="uk-inline" role="group">
        <span class="uk-form-icon uk-form-icon-flip magnifier-icon" uk-icon="icon:search"></span>
        <input name="searchword" id="mod-search-searchword<?= $module->id ?>" maxlength="200" class="inputbox search-query input-medium" type="search" size="20" placeholder="<?= $text ?>" tabindex="0" aria-label="Buscador"/>
    </div>
    <input type="hidden" name="task" value="search" />
    <input type="hidden" name="option" value="com_search" />
    <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
</form>
