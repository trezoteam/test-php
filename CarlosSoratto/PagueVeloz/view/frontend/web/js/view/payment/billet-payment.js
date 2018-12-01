define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'billet',
                component: 'CarlosSoratto_PagueVeloz/js/view/payment/method-renderer/billet-method'
            }
        );
        return Component.extend({});
    }
);
