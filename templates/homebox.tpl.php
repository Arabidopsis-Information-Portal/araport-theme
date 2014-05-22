<?php

/**
 * @file
 * homebox.tpl.php
 * Default layout for homebox.
 */
?>
<?php global $user; ?>
<div id="homebox" class="<?php print $classes ?> clearfix">
  <?php if ($user->uid): ?>
    <div id="homebox-buttons">
      <?php if (!empty($add_links)): ?>
        <a href="javascript:void(0)" id="homebox-add-link" class="btn btn-default">
          <i class="glyphicon glyphicon-plus"></i>
          <?php print t('Add a block') ?>
        </a>
      <?php endif; ?>
      <?php print $save_form; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($add_links)): ?>
    <div id="homebox-add" class="well">
      <?php print $add_links; ?>
      <b>Legend:</b>
      <span class="label label-default label-used">Used</span>
      <span class="label label-info">Not used</span>
    </div>
  <?php endif; ?>
  <div class="homebox-maximized"></div>
  <div class="row">
  <?php for ($i = 1; $i <= count($regions); $i++): ?>
    <div class="col-md-<?php print(12 / count($regions)); ?> homebox-column-wrapper homebox-column-wrapper-<?php print $i; ?> homebox-row-<?php print $page->settings['rows'][$i]; ?>">
      <div class="homebox-column" id="homebox-column-<?php print $i; ?>">
        <?php foreach ($regions[$i] as $key => $weight): ?>
          <?php foreach ($weight as $block): ?>
            <?php if ($block->content): ?>
              <?php print theme('homebox_block', array('block' => $block, 'page' => $page)); ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endfor; ?>
  </div>
</div>
<!-- hello homebox -->
<script type="text/javascript">
!function($){
  $('.panel-actions a').tooltip({
    title: function() {
      switch ($(this).attr('class').replace('glyphicon portlet-', '')) {
      case 'close':
        return Drupal.t('Close');
      case 'maximize':
        return Drupal.t('Maximize');
      case 'minimize':
        return Drupal.t('Minimize');
      case 'minus':
        return Drupal.t('Hide');
      case 'plus':
        return Drupal.t('Show');
      case 'settings':
        return Drupal.t('Settings');
      }
    }
  });
  $('#homebox-add a').addClass('btn btn-info');
  $('#homebox-add a.used').removeClass('btn-info').addClass('btn-default');
  $('#homebox-add a.restore').removeClass('btn-info').addClass('btn-warning');
}(jQuery);
</script>
