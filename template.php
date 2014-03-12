<?php

/**
 * @file
 * template.php
 */
function araport_theme_preprocess_page(&$variables) {

  // Help nav.
  // Build links.
  $variables['help_nav'] = menu_tree('menu-help-menu');
  // Provide default theme wrapper function.
  $variables['help_nav']['#theme_wrappers'] = array('menu_tree__primary');
}

/**
 * Theme wrapper function for the help menu links.
 */
function araport_theme_menu_tree__menu_help_menu(&$variables) {
  return '<ul class="menu nav nav-pills help">' . $variables['tree'] . '</ul>';
}