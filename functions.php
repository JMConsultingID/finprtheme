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

// Define constants for plugin paths.
define('FIN_THEME_VERSION', '1.1.1');
define('FIN_THEME_DIR', plugin_dir_path(__FILE__));
define('FIN_THEME_URL', plugin_dir_url(__FILE__));


/**
 * Initialize the plugin.
 */
class Finprtheme_Checkout {
    public function __construct() {
        // Include necessary files.
        $this->includes();

        // Initialize the plugin features.
        $this->init();
        add_action('wp_enqueue_scripts', [$this, 'fin_theme_scripts_styles'], 20);
        add_action('wp', [$this, 'fin_remove_order_review_from_checkout']);
        add_action('woocommerce_checkout_before_order_review', 'woocommerce_order_review', 10);
        add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
    }

    private function includes() {
        require_once FIN_THEME_DIR . 'inc/public/class-single-product-checkout.php';
        require_once FIN_THEME_DIR . 'inc/public/class-checkout-additional-fee-platform.php';
    }

    private function init() {
        new FinPr_Single_Product_Checkout();
        new FinPr_Additional_Platform_Fee_Checkout();
    }

    public function fin_remove_order_review_from_checkout() {
        remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
        remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
    }

    function fin_theme_scripts_styles()
    {
        wp_enqueue_style('fin-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css', [], '5.3.0-alpha3');
        wp_enqueue_style('fin-theme-style', get_stylesheet_directory_uri() . '/style.css', [], FIN_THEME_VERSION);
        wp_enqueue_style('fin-theme-custom-style', get_stylesheet_directory_uri() . '/assets/css/finprtheme.css', [], FIN_THEME_VERSION);
        wp_enqueue_script('fin-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.0-alpha3', true);
        wp_enqueue_script('fin-script', get_stylesheet_directory_uri() . '/assets/js/finprtheme.js', [], FIN_THEME_VERSION, true);  
        wp_enqueue_script('fin-platform-script', get_stylesheet_directory_uri() . '/assets/js/finprtheme_platform.js', [], FIN_THEME_VERSION, true);
    }    

}

new Finprtheme_Checkout();