// phone mask
var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options = {
        onKeyPress: function (val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
        }
    };

// Apply masks:
$('.phone').mask(maskBehavior, options);
$('.document').mask('000.000.000-00');
$('.birth').mask('00/00/0000');
$('.card-expiry').mask('00 / 00');
$('.height_in_cm').mask('0,00');