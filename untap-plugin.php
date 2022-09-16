<?php
/**
 * Plugin Name: Untap Plugin
 * Plugin URI: https://untap.tech/
 * Description: Senior Wordpress Developer assignment.
 * Version: 0.0.1
 * Author: Adil Elsaeed
 * Author URI: https://www.linkedin.com/in/adilelsaeed/
 * Text Domain: untap
 * Domain Path: /i18n/languages/
 * Requires at least: 6.0
 * Requires PHP: 7.4
 *
 * @package Untap
 */

defined( 'ABSPATH' ) || exit;

/**
 * Some conests to easly edit ids if changed
 */
define( 'UNTP_ACCOUNT_PAGE_ID', 6 );
define( 'UNTP_SOCRE_FORM_ID', 1 );
define( 'UNTP_FINAL_SCORE_FIELD_ID', 7 );
define( 'UNTP_SCORE1_FIELD_ID', 3 );
define( 'UNTP_SCORE2_FIELD_ID', 4 );
define( 'UNTP_SCORE3_FIELD_ID', 5 );

/**
 * Load plugin textdomain.
 */
add_action( 'init', 'untp_load_textdomain' );
function untp_load_textdomain() {
  load_plugin_textdomain( 'untap', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

/**
 * plugin style.
 */
function untp_style() {
  wp_enqueue_style( 'untp-style', plugins_url( 'assets/css/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'untp_style' );


/**
 * Our plugin files
 */
// Score form related
require_once __DIR__ . '/inc/final-score-checkbox.php';
require_once __DIR__ . '/inc/score-form-after-submit-hook.php';
require_once __DIR__ . '/inc/hide-score-form-after-submit.php';
// login and signup
require_once __DIR__ . '/inc/login-shortcode.php';
require_once __DIR__ . '/inc/signup-shortcode.php';

