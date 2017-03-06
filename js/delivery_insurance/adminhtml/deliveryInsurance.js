(function($) {
    $(document).ready(function() {
        var absolutePriceEl = $('#checkout_backend_delivery_insurance_absolute'),
            absoluteValueEl = $('#checkout_backend_delivery_insurance_absolute_value'),
            percentEl = $('#checkout_backend_delivery_insurance_percent');

        disableElement(absoluteValueEl, true);

        absolutePriceEl.on('change', function () {
            if ($(this).val() == 1) {
                disableElement(absoluteValueEl, false);
                disableElement(percentEl, true);
            } else {
                disableElement(absoluteValueEl, true);
                disableElement(percentEl, false);
            }
        });

        function disableElement(el, mode) {
            el.attr('disabled', mode);
        }
    });
})(jQuery);