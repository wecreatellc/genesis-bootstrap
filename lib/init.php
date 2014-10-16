<?php
/**
 * Genesis Bootstrap.
 *
 * @package GenesisBootstrap
 * @author  weCreate LLC
 * @license MIT
 * @link    https://github.com/zlanich/genesis-bootstrap
 */

add_action( 'genesis_bootstrap_init', 'genesis_bootstrap_constants' );
function genesis_bootstrap_constants() {

  define( 'GENESIS_BOOTSTRAP_IMAGES_DIR', CHILD_DIR . '/images' );
  define( 'GENESIS_BOOTSTRAP_LIB_DIR', CHILD_DIR . '/lib' );
  define( 'GENESIS_BOOTSTRAP_ADMIN_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/admin' );
  define( 'GENESIS_BOOTSTRAP_ADMIN_IMAGES_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/admin/images' );
  define( 'GENESIS_BOOTSTRAP_JS_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/js' );
  define( 'GENESIS_BOOTSTRAP_CSS_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/css' );
  define( 'GENESIS_BOOTSTRAP_CLASSES_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/classes' );
  define( 'GENESIS_BOOTSTRAP_FUNCTIONS_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/functions' );
  define( 'GENESIS_BOOTSTRAP_SHORTCODES_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/shortcodes' );
  define( 'GENESIS_BOOTSTRAP_STRUCTURE_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/structure' );
  define( 'GENESIS_BOOTSTRAP_TOOLS_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/tools' );
  define( 'GENESIS_BOOTSTRAP_WIDGETS_DIR', GENESIS_BOOTSTRAP_LIB_DIR . '/widgets' );

}


add_action( 'genesis_bootstrap_init', 'genesis_bootstrap_load_framework' );
function genesis_bootstrap_load_framework() {

  //* Short circuit, if necessary
  if ( defined( 'GENESIS_BOOTSTRAP_LOAD_FRAMEWORK' ) && GENESIS_BOOTSTRAP_LOAD_FRAMEWORK === false ) {
    return;
  }

  define( 'GENESIS_BOOTSTRAP_LOAD_FRAMEWORK', false );

  //* Load Functions
  require_once( GENESIS_BOOTSTRAP_FUNCTIONS_DIR . '/menu.php' );

  //* Load Structure
  require_once( GENESIS_BOOTSTRAP_STRUCTURE_DIR . '/footer.php' );
  require_once( GENESIS_BOOTSTRAP_STRUCTURE_DIR . '/menu.php' );
  require_once( GENESIS_BOOTSTRAP_STRUCTURE_DIR . '/layout.php' );

}

do_action( 'genesis_bootstrap_init' );