<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/tfb-elementor-theme/
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
    wp_enqueue_style('tfb-theme-style', get_stylesheet_directory_uri() . '/style.css', [], FIN_THEME_VERSION);
    wp_enqueue_style('tfb-theme-custom-style', get_stylesheet_directory_uri() . '/assets/css/tfb-theme.css', [], FIN_THEME_VERSION);
    wp_enqueue_script('tfb-theme-custom-script', get_stylesheet_directory_uri() . '/assets/js/tfb-theme.js', [], FIN_THEME_VERSION, true);
}
add_action('wp_enqueue_scripts', 'fin_theme_scripts_styles', 20);