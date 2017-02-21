(function($) {
    $(document).ready(function() {
       $('#opc-shipping_method').on('change', 'input[type=radio]', function () {
           $('#delivery-insurance').prop('checked', false);
        });

        $('#delivery-insurance').on('change', function () {
            //console.log($('#co-shipping-method-form').find('input[type=radio]'));
            //console.log($('#co-shipping-method-form').find('input[type=radio]:checked').val());

           // var data = { 'quoteId': $('#quote-id').val() };
            var shippingMethodId = $('#co-shipping-method-form').find('input[type=radio]:checked').val();
            var quoteId = $('#quote-id').val();

            $.post(
                url,
                {
                    quoteId: quoteId,
                    shippingMethodId: shippingMethodId
                },
                function(data) {
                }
            );
        });
    });
})(jQuery);