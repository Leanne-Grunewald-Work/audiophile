<?php


defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_checkout_form', $checkout );

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="checkout-page container mx-auto max-w-screen-xl py-20 px-6 grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- Left: Billing & Shipping -->
        <div class="lg:col-span-2 bg-white p-10 rounded-lg shadow space-y-10">
            <h2 class="text-2xl font-bold uppercase tracking-wide text-black">Checkout</h2>

            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div class="space-y-10">
                <div id="billing" class="space-y-4">
                    <h3 class="text-sm font-semibold text-[#D87D4A] uppercase">Billing Details</h3>
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>

                <div id="shipping" class="space-y-4">
                    <h3 class="text-sm font-semibold text-[#D87D4A] uppercase">Shipping Info</h3>
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <div id="payment-methods" class="space-y-4">
                <h3 class="text-sm font-semibold text-[#D87D4A] uppercase">Payment Details</h3>
                <?php do_action( 'woocommerce_checkout_payment' ); ?>
            </div>
        </div>

        <!-- Right: Order Summary -->
        <div class="bg-gray-100 p-6 rounded-lg">
            <h3 class="text-lg font-semibold uppercase mb-4">Summary</h3>

            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>

            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>
    </div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
