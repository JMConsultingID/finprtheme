<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class FinPr_Additional_Platform_Fee_Checkout
 *
 * Handles WooCommerce checkout modifications for single-product checkout mode.
 */
class FinPr_Additional_Platform_Fee_Checkout {
    /**
     * Constructor: Register hooks and filters.
     */
    public function __construct() {
        add_action('woocommerce_cart_calculate_fees', [$this, 'finpr_add_mt5_platform_fee']);
        add_action('wp_ajax_update_mt_version', [$this, 'handle_update_mt_version']);
        add_action('wp_ajax_nopriv_update_mt_version', [$this, 'handle_update_mt_version']);
    }

    /**
     * Add MT5 platform fee to cart
     *
     * @param WC_Cart $cart Cart object
     */
    public function finpr_add_mt5_platform_fee($cart) {
        if (is_admin() && !defined('DOING_AJAX')) {
            return;
        }
        // Get the selected platform from POST or session
        $selected_platform = WC()->session->get('selected_mt_version');
        
        // Only apply fee if MT5 is selected
        if ($selected_platform === 'MT5') {
            $cart_total = $cart->get_subtotal();
            $fee = $cart_total * 0.15; // 15% of total
            $cart->add_fee('MT5 Platform Fee', $fee);
        }
    }

    /**
     * Handle AJAX request to update MT version
     */
    public function handle_update_mt_version() {
        if (isset($_POST['platform'])) {
            WC()->session->set('selected_mt_version', sanitize_text_field($_POST['platform']));
        }
        wp_die();
    }
}