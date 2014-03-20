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

/**
 * Overrides theme_button().
 */
function araport_theme_button($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'value', 'type'));

  // If a button type class isn't present then add in default.
  $button_classes = array(
    'btn-default',
    'btn-primary',
    'btn-success',
    'btn-info',
    'btn-warning',
    'btn-danger',
    'btn-link',
  );
  $class_intersection = array_intersect($button_classes, $element['#attributes']['class']);
  if (empty($class_intersection)) {
    $element['#attributes']['class'][] = 'btn-default';
  }

  // Add in the button type class.
  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];

  // This line break adds inherent margin between multiple buttons.
  return '<input' . drupal_attributes($element['#attributes']) . '>'."\n";
}
