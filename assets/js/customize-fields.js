
/*
 * Customize fields js functions  
 * 
 * @author quangdung
 * @since 1.0.0
 */


wp.customize.controlConstructor['tpfw_select'] = wp.customize.Control.extend({
    // When we're finished loading continue processing
    ready: function () {

        'use strict';

        var control = this,
                element = this.container.find('select'),
                multiple = element.data('multiple'),
                selectValue;

        // If this is a multi-select control,
        // then we'll need to initialize selectize using the appropriate arguments.
        // If this is a single-select, then we can initialize selectize without any arguments.

        if (multiple) {
            jQuery(element).selectize({
                plugins: ['remove_button', 'drag_drop']
            });
        }

        // Change value
        this.container.on('change', 'select', function () {

            selectValue = jQuery(this).val();

            // If this is a multi-select, then we need to convert the value to an object.
            if (multiple) {
                selectValue = _.extend({}, jQuery(this).val());
            }

            control.setting.set(selectValue);

        });

    }

});

jQuery(function ($) {

    'use strict';

    if (document.getElementsByClassName('tpfw-icon_picker').length) {
        $('#widgets-right .customize-control .tpfw-icon_picker:not(.child-field) select').fontIconPicker();
    }

    if (document.getElementsByClassName('tpfw-repeater').length) {
        $('#widgets-right .tpfw-repeater').tpfwRepeater();
    }

    if (document.getElementsByClassName('tpfw-map').length) {
        $('#widgets-right .tpfw-map').tpfwMap();
    }
    
    if (document.getElementsByClassName('tpfw-datetime').length) {
        $('#widgets-right .tpfw-datetime input').each(function () {
            var data = $(this).tpfwData();
            $(this).datetimepicker(data);
        });
    }

    if (document.getElementsByClassName('tpfw-link').length) {
        $('#widgets-right .customize-control .tpfw-link').tpfwLink();
    }

    $('.accordion-section').on('expanded', function () {
        if ($(this).find('.tpfw-map:not(.child-field)').length) {
            $(this).find('.tpfw-map:not(.child-field)').tpfwMap();
        }
    });

    if (document.getElementsByClassName('tpfw-typography').length) {
        $('#widgets-right .customize-control .tpfw-typography').tpfwTypography();
    }

    var $textarea = $('textarea.custom_code'), textarea = $textarea[0];

    $textarea.on('blur', function onBlur() {
        $textarea.data('next-tab-blurs', false);
    });

    $textarea.on('keydown', function onKeydown(event) {
        var selectionStart, selectionEnd, value, tabKeyCode = 9, escKeyCode = 27;

        if (escKeyCode === event.keyCode) {
            if (!$textarea.data('next-tab-blurs')) {
                $textarea.data('next-tab-blurs', true);
                event.stopPropagation(); // Prevent collapsing the section.
            }
            return;
        }

        // Short-circuit if tab key is not being pressed or if a modifier key *is* being pressed.
        if (tabKeyCode !== event.keyCode || event.ctrlKey || event.altKey || event.shiftKey) {
            return;
        }

        // Prevent capturing Tab characters if Esc was pressed.
        if ($textarea.data('next-tab-blurs')) {
            return;
        }

        selectionStart = textarea.selectionStart;
        selectionEnd = textarea.selectionEnd;
        value = textarea.value;

        if (selectionStart >= 0) {
            textarea.value = value.substring(0, selectionStart).concat('\t', value.substring(selectionEnd));
            $textarea.selectionStart = textarea.selectionEnd = selectionStart + 1;
        }

        event.stopPropagation();
        event.preventDefault();
    });


    /**
     * Field Autocomplete
     */
    if (document.getElementsByClassName('tpfw-autocomplete').length) {
        $('#widgets-right .customize-control .tpfw-autocomplete:not(.child-field) select').tpfwAutocomplete();

        $('#widgets-right').on('change', '.customize-control .tpfw-autocomplete select', function () {
            $(this).closest('div').find('.tpfw_value').val($(this).val()).trigger('change');
        });
    }
});

(function ($) {

    wp.customize.bind('ready', function () {


        if (typeof tpfw_customizer_dependency == 'object') {

            $.each(tpfw_customizer_dependency, function (slave, masters) {

                $.each(masters, function (key, value) {
                    masters['[data-customize-setting-link="' + key + '"]'] = value;
                    delete masters[key];
                });
                
                if ($('#customize-control-' + slave).length) {
                    $('#customize-control-' + slave).dependsOn(masters);
                }

            });
        }

    }
    );

})(jQuery);