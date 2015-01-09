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

/**
 * Overrides hook_bootstrap_search_form_wrapper();
 */
function araport_theme_bootstrap_search_form_wrapper($variables) {
  $output = '<div class="input-group">';
  $output .= $variables['element']['#children'];
  $output .= '<span class="input-group-btn">';
  $output .= '<button type="submit" class="btn btn-default">';
  // We can be sure that the font icons exist in CDN.
  // if (theme_get_setting('bootstrap_cdn')) {
    $output .= _bootstrap_icon('search');
  // }
  // else {
  //   $output .= t('Search');
  // }
  $output .= '</button>';
  $output .= '</span>';
  $output .= '</div>';
  return $output;
}

/**
 * Overrides theme_menu_tree().
 * @see @file theme/menu/menu-tree.func.php from bootstrap parent theme
 */
function araport_theme_menu_tree(&$variables) {
  if (strpos($variables['theme_hook_original'], 'book_toc') !== FALSE) {
    return '<ul class="menu book-toc nav">' . $variables['tree'] . '</ul>';
  } else {
    return '<ul class="menu nav">' . $variables['tree'] . '</ul>';
  }
}

/**
 * Overrides theme_menu_link().
 * @see @file theme/menu/menu-link.func.php from bootstrap parent theme
 * Make /user active for current user /user/<uid>
 */
function araport_theme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }

  // Book TOC
  if (strpos($element['#original_link']['menu_name'], 'book-toc') !== FALSE) {
    if ($element['#below']) {
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="menu nav">' . drupal_render($element['#below']) . '</ul>';
    }
  }

  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  } else if ($element['#href'] == 'user') {
    if (preg_match('/user\/(\d+)/', $_GET['q'], $matches)) {
      global $user;
      if ($user->uid == $matches[1]) {
        $element['#attributes']['class'][] = 'active';
      }
    }
  }

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements template_preprocess_book_navigation().
 * @see https://api.drupal.org/api/drupal/modules!book!book.module/function/template_preprocess_book_navigation/7
 *
 * Add a complete Table of Contents to the first book page
 */
function araport_theme_preprocess_book_navigation(&$vars) {
  $vars['table_of_contents'] = '';
  if ($vars['current_depth'] == 1) {
    $items = array();

    $node = node_load($vars['book_id']);
    $tree = book_menu_subtree_data($node->book);
    $tree = array_shift($tree); // Do not include the book item itself.
    if ($tree['below']) {
      foreach ($tree['below'] as $page) {
        $items[] = araport_theme_book_toc($page);
      }
    }
    $vars['table_of_contents'] = theme('item_list', array('items' => $items, 'title' => t('Table of contents')));
  }
}

function araport_theme_book_toc($page) {
  $item = array(
    'data' => l(t($page['link']['link_title']), $page['link']['link_path'])
  );
  if ($page['below']) {
    $item['children'] = array();
    foreach ($page['below'] as $child_page) {
      $item['children'][] = araport_theme_book_toc($child_page);
    }
  }
  return $item;
}
