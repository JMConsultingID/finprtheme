<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}
?>

<div id="yourpropfirm-multi-step-checkout">
    <!-- Step Navigation -->
    <ul class="checkout-steps">
        <li class="step active" data-step="1">1. Select Account</li>
        <li class="step" data-step="2">2. Billing Details</li>
        <li class="step" data-step="3">3. Make Payment</li>
    </ul>

    <form name="checkout" method="post" class="checkout woocommerce-checkout hello-theme-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
        <?php if ($checkout->get_checkout_fields()) : ?>
            
            <!-- Step 1: Account Selection -->
            <div class="checkout-step-content active" data-step="1">
                <h3>Select Account</h3>
                <?php do_action('yourpropfirm_checkout_variant_selector'); ?>
                <?php do_action('woocommerce_checkout_before_customer_details'); ?>
                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>
                <button type="button" class="next-step" data-next="2">Next</button>
            </div>
            
            <!-- Step 2: Billing Details -->
            <div class="checkout-step-content" data-step="2">
                <h3>Billing Details</h3>
                <div id="customer_details">
                    <div class="container">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>
                </div>
                <button type="button" class="prev-step" data-prev="1">Back</button>
                <button type="button" class="next-step" data-next="3">Next</button>
            </div>
            
            <!-- Step 3: Payment -->
            <div class="checkout-step-content" data-step="3">
                <h3>Choose Payment Method</h3>
                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
                <?php do_action('woocommerce_checkout_payment'); ?>
                <button type="button" class="prev-step" data-prev="2">Back</button>
                <button type="submit" class="place-order">Place Order</button>
            </div>
            
        <?php endif; ?>
    </form>
</div>

<script>
(function($) {
    'use strict';
    
    $(document).ready(function() {
        function updateStep(step) {
            $('.checkout-step-content').removeClass('active');
            $('.checkout-step-content[data-step="' + step + '"]').addClass('active');
            
            $('.checkout-steps .step').removeClass('active');
            $('.checkout-steps .step[data-step="' + step + '"]').addClass('active');
        }

        $('.checkout-steps .step').on('click', function() {
            var step = $(this).data('step');
            updateStep(step);
        });

        $('.next-step').on('click', function() {
            var nextStep = $(this).data('next');
            updateStep(nextStep);
        });

        $('.prev-step').on('click', function() {
            var prevStep = $(this).data('prev');
            updateStep(prevStep);
        });
    });

})(jQuery);
</script>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>