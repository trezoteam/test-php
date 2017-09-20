require([
        'jquery',
        'mage/translate',
        'jquery/validate'],
    function($){
        $.validator.addMethod(
            'validate-integer', function (v) {
                return (v.match("^[0-9]+$"));
            }, $.mage.__('Field must be an integer number'));
    }
);