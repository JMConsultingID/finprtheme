<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/fin-elementor-theme/
 *
 * @package fin-theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('FIN_THEME_VERSION', '1.1.1');

/**
 * Load tfb theme scripts & styles.
 *
 * @return void
 */

function fin_theme_scripts_styles()
{
    wp_enqueue_style('fin-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css', [], '5.3.0-alpha3');
    wp_enqueue_style('fin-theme-style', get_stylesheet_directory_uri() . '/style.css', [], FIN_THEME_VERSION);
    wp_enqueue_style('fin-theme-custom-style', get_stylesheet_directory_uri() . '/assets/css/finprtheme.css', [], FIN_THEME_VERSION);
    wp_enqueue_script('fin-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.0-alpha3', true);
    wp_enqueue_script('fin-theme-custom-script', get_stylesheet_directory_uri() . '/assets/js/finprtheme.js', [], FIN_THEME_VERSION, true);    
}
add_action('wp_enqueue_scripts', 'fin_theme_scripts_styles', 20);

// Remove order review from the checkout page
add_action('wp', 'remove_order_review_from_checkout');
function remove_order_review_from_checkout() {
    remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
}

// Ensure payment options are displayed
add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);