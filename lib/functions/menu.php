<?php

/**
 * Return the markup to display a menu consistent with the Genesis format.
 *
 * Applies the `genesis_$location_nav` filter e.g. `genesis_header_nav`. For primary and secondary menu locations, it
 * also applies the `genesis_do_nav` and `genesis_do_subnav` filters for backwards compatibility.
 *
 * Makes Genesis Structural Wrap optional for better Bootstrap 3 compatibility
 *
 * @since 2.1.0
 *
 * @uses genesis_markup()             Contextual markup.
 * @uses genesis_html5()              Check for HTML5 support.
 * @uses genesis_structural_wrap()    Adds optional internal wrap divs.
 *
 * @param string $args Menu arguments.
 *
 * @return string Navigation menu markup.
 */
function gb_genesis_get_nav_menu( $args = array(), $structural_wrap = false ) {

  $args = wp_parse_args( $args, array(
      'theme_location' => '',
      'container'      => '',
      'menu_class'     => 'menu genesis-nav-menu',
      'echo'           => 0,
  ) );

  //* If a menu is not assigned to theme location, abort
  if ( ! has_nav_menu( $args['theme_location'] ) ) {
    return;
  }

  $sanitized_location = sanitize_key( $args['theme_location'] );

  $nav = wp_nav_menu( $args );

  //* Do nothing if there is nothing to show
  if ( ! $nav ) {
    return;
  }

  $xhtml_id = $args['theme_location'];

  if ( 'primary' === $args['theme_location'] ) {
    $xhtml_id = 'nav';
  } elseif ( 'secondary' === $args['theme_location'] ) {
    $xhtml_id = 'subnav';
  }

  $nav_markup_open = genesis_markup( array(
      'html5'   => '<nav %s>',
      'xhtml'   => '<div id="' . $xhtml_id . '">',
      'context' => 'nav-' . $sanitized_location,
      'echo'    => false,
  ) );

  $nav_markup_close = '';

  if ( $structural_wrap ) {
    $nav_markup_open .= genesis_structural_wrap( 'menu-' . $sanitized_location, 'open', 0 );
    $nav_markup_close .= genesis_structural_wrap( 'menu-' . $sanitized_location, 'close', 0 );
  }

  $nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';

  $nav_output = $nav_markup_open . $nav . $nav_markup_close;

  $filter_location = 'genesis_' . $sanitized_location . '_nav';

  //* Handle back-compat for primary and secondary nav filters.
  if ( 'primary' === $args['theme_location'] ) {
    $filter_location = 'genesis_do_nav';
  } elseif ( 'secondary' === $args['theme_location'] ) {
    $filter_location = 'genesis_do_subnav';
  }

  /**
   * Filter the navigation markup.
   *
   * @since 2.1.0
   *
   * @param string $nav_output Opening container markup, nav, closing container markup.
   * @param string $nav Navigation list (`<ul>`).
   * @param array $args {
   *     Arguments for `wp_nav_menu()`.
   *
   *     @type string $theme_location Menu location ID.
   *     @type string $container Container markup.
   *     @type string $menu_class Class(es) applied to the `<ul>`.
   *     @type bool $echo 0 to indicate `wp_nav_menu()` should return not echo.
   * }
   */
  return apply_filters( $filter_location, $nav_output, $nav, $args );
}

/**
 * Echo the output from `genesis_get_nav_menu()`.
 *
 * @since 2.1.0
 *
 * @uses genesis_get_nav_menu() Return the markup to display a menu consistent with the Genesis format.
 *
 * @param string $args Menu arguments.
 */
function gb_genesis_nav_menu( $args ) {
  echo gb_genesis_get_nav_menu( $args );
}