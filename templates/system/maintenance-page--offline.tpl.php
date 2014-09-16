<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 *
 * @ingroup themeable
 */

 // values otherwise loaded from the database
 $site_name = 'Arabidopsis Information Portal';
 $title = 'Site under maintenance';
 $head_title = $title . ' | ' . $site_name;
 $site_slogan = 'We\'ll be right back!';
 $content = 'Arabidopsis Information Portal is currently under maintenance. We should be back shortly. Thank you for your patience.';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php print $scripts; ?>
  <script type="text/javascript">jQuery.curCSS=jQuery.css;</script>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <header role="banner">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-7">
          <?php if ($logo): ?>
          <div id="logo" class="logo">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
            </a>
          </div>
          <?php endif; ?>

          <div id="name-and-slogan">
            <?php if (!empty($site_name)): ?>
            <h1 class="site-name"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a></h1>
            <?php endif; ?>

            <?php if (!empty($site_slogan)): ?>
            <h2 class="site-slogan"><?php print $site_slogan; ?></h2>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div id="navbar" class="navbar navbar-static-top navbar-inverse"></div>
  </header>

  <div class="main-container container" role="main">
    <section class="jumbotron">
      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $content; ?>
    </section>
  </div>
  <footer class="footer container">
    <div class="region region-footer">
      <div id="block-block-1" class="clearfix block block-block">
        <div class="content">
          <style type="text/css">
            <!--
            /*--><![CDATA[/* ><!--*/
            .footer-partners > a {
              display: inline-block;
              margin: .5em;
            }
            /*--><!]]>*/
          </style>
          <p class="text-center footer-partners">
            <a href="http://www.jcvi.org/" target="_blank">
              <img src="/sites/default/files/jcvi.jpg">
            </a>
            <a href="http://www.tacc.utexas.edu" target="_blank">
              <img src="/sites/default/files/tacc.jpg">
            </a>
            <a href="http://www.cam.ac.uk/" target="_blank">
              <img src="/sites/default/files/cambridge.jpg">
            </a>
            <a href="http://intermine.org" target="_blank">
              <img src="/sites/default/files/intermine.jpg">
            </a>
            <a href="http://iplantcollaborative.org" target="_blank">
              <img src="/sites/default/files/iplant.jpg">
            </a>
          </p>
          <p class="text-center">The Arabidopsis Information Portal is funded by a grant from the National Science Foundation (<a href="http://www.nsf.gov/awardsearch/showAward?AWD_ID=1262414" target="_blank">#DBI-1262414</a>)
            <br>and co-funded by a grant from the Biotechnology and Biological Sciences Research Council (<a href="http://www.bbsrc.ac.uk/pa/grants/AwardDetails.aspx?FundingReference=BB/L027151/1" target="_blank">BB/L027151/1</a>)</p>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
