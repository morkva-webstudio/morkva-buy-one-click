jQuery(document).ready(function($) {
    jQuery('.mrkv_buy-one-click__open-call').on('click', function() {
        jQuery('.mrkv_buy-one-click__form__inner, .mrkv_buy-one-click__overlay').fadeIn(500);
    });
    jQuery('.mrkv_buy-one-click__overlay, .mrkv_buy-one-click__close_form').on('click', function() {
        jQuery('.mrkv_buy-one-click__form__inner, .mrkv_buy-one-click__overlay').fadeOut(500);
        jQuery('.mrkv_buy-one-click__form__inner__result').hide();
        jQuery('.mrkv_buy-one-click__form__inner__info').show();
    });
    jQuery('.mrkv_buy-one-click__create_order').on('click', function() {
        jQuery('.mrkv_buy-one-click__loader').show();

        let product_id = jQuery('.mrkv_buy-one-click__product-data').attr('data-prod-id');
        let first_name = jQuery('#mrkv_buy-one-click__username').val();
        let phone = jQuery('#mrkv_buy-one-click__phone').val();
        let is_quote = jQuery('#mrkv_buy-one-click__is_quote').val() === '1' ? 1 : 0;

        if(product_id && first_name && phone)
        {
            jQuery.ajax({
                type: 'POST',
                url: mrkv_buy_one_click_helper.ajax_url,
                data: {
                    action: 'mrkv_buy_one_click__create_order',
                    product_id: product_id,
                    first_name: first_name,
                    phone: phone,
                    is_quote: is_quote,
                    nonce: mrkv_buy_one_click_helper.nonce,
                },
                success: function (data) {
                    if (data.success && data.data.order_number) {
                        jQuery('.mrkv_buy-one-click__order_number').text(data.data.order_number);
                    } else if (data.data && data.data.message) {
                        jQuery('.mrkv_buy-one-click__form__inner__result h2').html(data.data.message);
                    }

                    jQuery('.mrkv_buy-one-click__form__inner__result').show();
                    jQuery('.mrkv_buy-one-click__form__inner__info').hide();
                    jQuery('.mrkv_buy-one-click__loader').hide();
                }
            });
        }
        else
        {
            if(!first_name)
            {
                jQuery('#mrkv_buy-one-click__username').css('border-color', 'red');
                setTimeout(function(){ jQuery('#mrkv_buy-one-click__username').css('border-color', 'inherit'); }, 5000);
            }
            if(!phone)
            {
                jQuery('#mrkv_buy-one-click__phone').css('border-color', 'red');
                setTimeout(function(){ jQuery('#mrkv_buy-one-click__phone').css('border-color', 'inherit'); }, 5000);
            }
            jQuery('.mrkv_buy-one-click__loader').hide();
        }
    });

    function mrkvBOCinitIntlTelInput(selector, defaultCountry = "us") {
        var input = document.querySelector(selector);
        if (input) {
            var iti = window.intlTelInput(input, {
                initialCountry: defaultCountry,
                preferredCountries: ["ua", "us", "gb", "fr", "de"],
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                separateDialCode: true
            });

            input.setAttribute('placeholder', '982133388');

            input.addEventListener("countrychange", function() {
                input.setAttribute('placeholder', iti.getSelectedCountryData().dialCode);
            });

            input.addEventListener('input', function(e) {
                var countryData = iti.getSelectedCountryData();
                var dialCode = countryData.dialCode;
                var maxLength = getMaxPhoneLength(countryData.iso2);

                var number = input.value.replace(/\D/g, '');

                if (dialCode === "380" && number.startsWith("380")) {
                    number = number.substring(3); // Remove the "380" part if the user tries to input it
                }

                if (dialCode === "380" && number.startsWith("38")) {
                    number = number.substring(2); // Remove the "380" part if the user tries to input it
                }

                if (dialCode === "380" && number.startsWith("3")) {
                    number = number.substring(1); // Remove the "380" part if the user tries to input it
                }

                if (dialCode === "380" && number.startsWith("8")) {
                    number = number.substring(1); // Remove the "380" part if the user tries to input it
                }

                if (dialCode === "380" && number.startsWith("80")) {
                    number = number.substring(2); // Remove the "380" part if the user tries to input it
                }

                if (dialCode === "380" && number.startsWith("0")) {
                    number = number.substring(1); // Remove the "380" part if the user tries to input it
                }

                if (number.length > maxLength) {
                    number = number.substring(0, maxLength);
                }

                if (dialCode === "380" && number.startsWith("0")) {
                    number = number.substring(1); 
                }

                input.value = number;
            });
        }
    }

    function getMaxPhoneLength(countryIso) {
        const phoneLengths = {
            ua: 9, 
            us: 10, 
            gb: 10, 
            fr: 9,  
            de: 11,
            default: 15 
        };
        return phoneLengths[countryIso] || phoneLengths.default;
    }

    
    mrkvBOCinitIntlTelInput("#mrkv_buy-one-click__phone", mrkv_buy_one_click_helper.default_country);
});
