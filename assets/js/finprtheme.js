(function($) {
    'use strict';

    $(document).ready(function() {
        function updateStep(step) {
            $('.checkout-step-content').removeClass('active');
            $('.step-' + step).addClass('active');

            $('.checkout-steps .nav-link').removeClass('active disabled');
            $('.checkout-steps .nav-link[data-step="' + step + '"]').addClass('active');
            $('.checkout-steps .nav-link[data-step]').not('.active').addClass('disabled');
        }

        $('.next-step').on('click', function() {
            let nextStep = $(this).data('next');
            updateStep(nextStep);
        });

        $('.prev-step').on('click', function() {
            let prevStep = $(this).data('prev');
            updateStep(prevStep);
        });
    });

})(jQuery);
