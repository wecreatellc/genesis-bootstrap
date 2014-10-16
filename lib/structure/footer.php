<?php

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_before_footer', 'gb_genesis_footer_widget_areas' );
/**
 * Tweak original logic to dynamically add footer-widgets wrapper class for active sidebar count
 *
 * Echo the markup necessary to facilitate the footer widget areas.
 *
 * Check for a numerical parameter given when adding theme support - if none is found, then the function returns early.
 *
 * The child theme must style the widget areas.
 *
 * Applies the `genesis_footer_widget_areas` filter.
 *
 * @since 1.6.0
 *
 * @uses genesis_structural_wrap() Optionally adds wrap with footer-widgets context.
 *
 * @return null Return early if number of widget areas could not be determined, or nothing is added to the first widget area.
 */
function gb_genesis_footer_widget_areas() {

  global $gb_active_footer_widget_areas;

  $footer_widgets = get_theme_support( 'genesis-footer-widgets' );

  if ( ! $footer_widgets || ! isset( $footer_widgets[0] ) || ! is_numeric( $footer_widgets[0] ) )
    return;

  $footer_widgets = (int) $footer_widgets[0];

  //* Check to see if first widget area has widgets. If not, do nothing. No need to check all footer widget areas.
  if ( ! is_active_sidebar( 'footer-1' ) )
    return;

  $inside  = '';
  $output  = '';
  $counter = 1;
  $active = 0;

  while ( $counter <= $footer_widgets ) {

    if ( is_active_sidebar( 'footer-' . $counter ) ) {

      //* Darn you, WordPress! Gotta output buffer.
      ob_start();
      dynamic_sidebar( 'footer-' . $counter );
      $widgets = ob_get_clean();

      $inside .= sprintf( '<div class="footer-widgets-%d widget-area">%s</div>', $counter, $widgets );

      $active++;

    }

    $counter++;

  }

  $gb_active_footer_widget_areas = $active;
  add_filter( 'genesis_attr_footer-widgets', 'gb_footer_widgets_count_class' );

  if ( $inside ) {

    $output .= genesis_markup( array(
        'html5'   => '<div %s>',
        'xhtml'   => '<div id="footer-widgets" class="footer-widgets">',
        'context' => 'footer-widgets',
    ) );

    $output .= genesis_structural_wrap( 'footer-widgets', 'open', 0 );

    $output .= '<div class="inner-wrap">' . $inside . '</div>';

    $output .= genesis_structural_wrap( 'footer-widgets', 'close', 0 );

    $output .= '</div>';

  }

  echo apply_filters( 'genesis_footer_widget_areas', $output, $footer_widgets );

}

function gb_footer_widgets_count_class( $attributes = array(), $widget_area_count = 3 ) {

  global $gb_active_footer_widget_areas;

  if ( array_key_exists( 'class', $attributes ) ) {
    $attributes['class'] .= empty( $attributes['class'] ) ? '' : ' ';
    $attributes['class'] .= 'active-'. $gb_active_footer_widget_areas;
  }

  return $attributes;

}

add_filter( 'genesis_footer_creds_text', 'gb_genesis_footer_creds_text' );
/**
 * Override footer creds text
 */
function gb_genesis_footer_creds_text( $creds_text ) {

  $creds_text = '<div class="creds"><p>';
  $creds_text .= 'Copyright &copy; ';
  $creds_text .= date('Y');
  $creds_text .= ' &middot; <a href="/">'. get_bloginfo('name') .'</a>';
  $creds_text .= '</p></div>';

  return $creds_text;

}