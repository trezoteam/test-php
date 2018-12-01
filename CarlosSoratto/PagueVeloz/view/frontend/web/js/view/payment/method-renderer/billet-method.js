define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'CarlosSoratto_PagueVeloz/payment/billet'
            },
            getMailingAddress: function() {
                return window.checkoutConfig.payment.billet.mailingAddress;
            }
        });
    }
);
