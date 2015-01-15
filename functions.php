<?php

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
include_once( CHILD_DIR . '/lib/init.php' );

// Load external classes/libs
require_once( CHILD_DIR . '/vendor/assets/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Bootstrap' );
define( 'CHILD_THEME_URL', 'https://github.com/zlanich/genesis-bootstrap' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
//add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Dequeue main stylesheet in favor of new compiled one(s) in /css - DOESN'T WORK
//remove_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet' );

/**
 * Cache busting
 * See https://github.com/zlanich/wecreate-cache-buster
 */
if ( class_exists( 'WeCreate_Cache_Buster' ) ) {
  $config = array(
      'rootPath'        => content_url() .'/',
      'cssTemplate'     => '<link href="{{ROOT_PATH}}/{{FILE_PATH}}/{{FILE_NAME}}.{{HASH}}.css" rel="stylesheet">',
      'jsTemplate'      => '<script src="{{ROOT_PATH}}/{{FILE_PATH}}/{{FILE_NAME}}.{{HASH}}.js"></script>',
      'bustersJsonPath' => get_stylesheet_directory() .'/cache/busters.json',
  );
  $onex_net_theme_buster = new WeCreate_Cache_Buster( $config );
}

add_action( 'wp_enqueue_scripts', 'gb_enqueue_main_stylesheet' );
/**
 * Enqueue compiled stylesheet(s)
 *
 * @since 1.0.0
 *
 * Original: <genesis parent theme>/css/load-styles.php:41
 */
function gb_enqueue_main_stylesheet() {

  // Genesis's old way of determining css version
  //$version = defined( 'CHILD_THEME_VERSION' ) && CHILD_THEME_VERSION ? CHILD_THEME_VERSION : PARENT_THEME_VERSION;
  $handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

  // Main Style
  $ver_hash = '1.0.0';
  if ( isset( $onex_net_theme_buster ) ) {
    $ver_hash = $onex_net_theme_buster->getHashByFilename( get_stylesheet_directory() . '/css/style.compiled.css' );
  }

  wp_enqueue_style( $handle. '-new', get_stylesheet_directory_uri() .'/css/style.compiled.css', false, $ver_hash );

}

add_action( 'wp_enqueue_scripts', 'gb_enqueue_scripts' );
/**
 * Enqueue front end scripts
 *
 * @since 1.0.0
 */
function gb_enqueue_scripts() {

  $version = defined( 'CHILD_THEME_VERSION' ) && CHILD_THEME_VERSION ? CHILD_THEME_VERSION : PARENT_THEME_VERSION;

  wp_enqueue_script( 'bootstrap-collapse', get_stylesheet_directory_uri() .'/vendor/assets/bootstrap/dist/js/bootstrap.min.js', array('jquery'), $version );

}