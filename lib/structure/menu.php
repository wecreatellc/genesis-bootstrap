<?php

remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_header', 'gb_genesis_do_nav' );
/**
 * Echo the "Primary Navigation" menu.
 *
 * Applies the `genesis_primary_nav` and legacy `genesis_do_nav` filters.
 *
 * Swaps in a Bootstrap-compatible menu-walker for Primary & Secondary menus
 * @link https://github.com/twittem/wp-bootstrap-navwalker Bootstrap Navwalker docs
 *
 * @since 1.0.0
 *
 * @uses genesis_nav_menu() Display a navigation menu.
 * @uses genesis_nav_menu_supported() Checks for support of specific nav menu.
 *
 * @todo Remove possibility of enabling Superfish where it shouldn't be
 */
function gb_genesis_do_nav() {

  //* Do nothing if menu not supported
  if ( ! genesis_nav_menu_supported( 'primary' ) )
    return;

  //$class = 'menu genesis-nav-menu menu-primary';
  $class = 'menu-primary nav navbar-nav';
  if ( genesis_superfish_enabled() ) {
    $class .= ' js-superfish';
  } ?>

  <div class="navbar navbar-default navbar-primary">

    <div class="container">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-container-primary">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <?php gb_genesis_nav_menu( array(
          'theme_location' => 'primary',
          'menu_class'     => $class,
          'depth'             => 2,
          'container'         => 'div',
          'container_id'      => 'nav-container-primary',
          'container_class'   => 'collapse navbar-collapse',
          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
          'walker'            => new wp_bootstrap_navwalker()
      ) ); ?>

    </div>

  </div>

<?php }

remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after_header', 'gb_genesis_do_subnav' );
/**
 * Echo the "Secondary Navigation" menu.
 *
 * Applies the `genesis_secondary_nav` and legacy `genesis_do_subnav` filters.
 *
 * Swaps in a Bootstrap-compatible menu-walker for Primary & Secondary menus
 * @link https://github.com/twittem/wp-bootstrap-navwalker Bootstrap Navwalker docs
 *
 * @since 1.0.0
 *
 * @uses genesis_nav_menu() Display a navigation menu.
 * @uses genesis_nav_menu_supported() Checks for support of specific nav menu.
 */
function gb_genesis_do_subnav() {

  //* Do nothing if menu not supported
  if ( ! genesis_nav_menu_supported( 'secondary' ) )
    return;

  //$class = 'menu genesis-nav-menu menu-secondary';
  $class = 'menu-secondary nav navbar-nav';
  if ( genesis_superfish_enabled() ) {
    $class .= ' js-superfish';
  } ?>

  <div class="navbar navbar-default navbar-secondary">

    <div class="container">

      <div class="navbar-header"></div>

      <?php gb_genesis_nav_menu( array(
          'theme_location' => 'secondary',
          'menu_class'     => $class,
          'depth'             => 2,
          'container'         => 'div',
          'container_id'      => 'nav-container-secondary',
          //'container_class'   => 'collapse navbar-collapse',
          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
          'walker'            => new wp_bootstrap_navwalker()
      ) ); ?>

    </div>

  </div>

<?php }