(function($) {
    $(document).ready(function() {
        var deliveryInsuranceEl = $('#delivery-insurance'),
            placeDeliveryInsuranceCost = $('#place-delivery-insurance-cost');

        $('#opc-shipping_method').on('change', 'input[type=radio]', function () {
            deliveryInsuranceEl.prop('checked', false);
            placeDeliveryInsuranceCost.empty();
        });

        deliveryInsuranceEl.on('change', function () {
            if (deliveryInsuranceEl.prop('checked')) {
                var shippingMethodId = $('#co-shipping-method-form').find('input[type=radio]:checked').val();

                $.post(
                    url,
                    {
                        shippingMethodId: shippingMethodId
                    },
                    function(data) {
                        placeDeliveryInsuranceCost.empty().append(data);
                    }
                )
            }
        });
    });
})(jQuery);