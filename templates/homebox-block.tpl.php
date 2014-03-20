<?php

/**
 * @file
 * homebox-block.tpl.php
 * Default theme implementation each homebox block.
 */
?>
<div id="homebox-block-<?php print $block->key; ?>" class="<?php print $block->homebox_classes ?> clearfix block block-<?php print $block->module ?>">
  <div class="homebox-portlet-inner panel panel-default">
    <div class="portlet-header panel-heading">
      <h3 class="panel-title"><?php print $block->subject ?>
        <div class="panel-actions pull-right">
          <?php if ($page->settings['color'] || isset($block->edit_form)): ?>
            <a class="glyphicon portlet-settings"></a>
          <?php endif; ?>
          <a class="glyphicon portlet-minus"></a>
          <a class="glyphicon portlet-maximize"></a>
          <?php if ($block->closable): ?>
            <a class="glyphicon portlet-close"></a>
          <?php endif; ?>
        </div>
      </h3>
    </div>
    <div class="portlet-config">
      <?php if ($page->settings['color']): ?>
        <div class="clearfix"><div class="homebox-colors">
          <span class="homebox-color-message"><?php print t('Select a color') . ':'; ?></span>
          <?php for ($i=0; $i < HOMEBOX_NUMBER_OF_COLOURS; $i++): ?>
            <span class="homebox-color-selector" style="background-color: <?php print $page->settings['colors'][$i] ?>;">&nbsp;</span>
          <?php endfor ?>
        </div></div>
      <?php endif; ?>
      <?php if (isset($block->edit_form)): print $block->edit_form; endif; ?>
    </div>
    <div class="portlet-content panel-body"><?php if (is_string($block->content)){ print $block->content; } else { print drupal_render($block->content); } ?></div>
  </div>
</div>
<!-- hello homebox-block -->