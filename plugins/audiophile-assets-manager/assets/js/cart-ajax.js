jQuery(document).ready(function($) {
    $(document).on('click', '.cart-update-btn', function(e) {
        e.preventDefault();

        const $btn = $(this);
        const key = $btn.data('key');
        const action = $btn.data('action');

        // Show spinner
        $btn.prop('disabled', true);
        $btn.find('.spinner').removeClass('hidden');

        const $overlay = $('#aam-cart-loading');

        // Show overlay
        $overlay.removeClass('hidden');

        $.ajax({
            type: 'POST',
            url: aam_ajax_obj.ajax_url,
            data: {
                action: 'aam_update_cart',
                nonce: aam_ajax_obj.nonce,
                cart_item_key: key,
                update_action: action,
            },
            success: function(response) {
                if (response.success) {
                    $('#aam-mini-cart-inner').html(response.data); // update the mini cart
                } else {
                    console.error('Cart update failed', response);
                }
            },
            error: function(err) {
                console.error('AJAX error:', err);
            },
            complete: function() {
                // Re-enable and hide spinner (in case DOM wasn’t replaced)
                $btn.prop('disabled', false);
                $btn.find('.spinner').addClass('hidden');

                // Hide overlay (only if the overlay is still in the DOM)
                $('#aam-cart-loading').addClass('hidden');

            }
        });
    });

    // Optional: Clear cart button handler
    $(document).on('click', '.clear-cart-btn', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: aam_ajax_obj.ajax_url,
            data: {
                action: 'aam_clear_cart',
                nonce: aam_ajax_obj.nonce,
            },
            success: function(response) {
                if (response.success) {
                    $('#aam-mini-cart-inner').html(response.data);
                } else {
                    console.error('Clear cart failed', response);
                }
            },
            error: function(err) {
                console.error('AJAX error:', err);
            }
        });
    });
});
