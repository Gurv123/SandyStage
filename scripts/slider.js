$(document).ready(function() {
    $("[name*='note']").each(function() {
        $(this).selectToUISlider({
            labels: 5
        });
    })

    //fix color 
    fixToolTipColor();
    hideSelectHandle();

    $(document).on("slide", function(event, ui) {
        var strUser = ui.value * 20;
        $(ui.handle.parentNode).find('.ui-widget-header')[0].style.width = strUser + '%';


    });



});
//purely for theme-switching demo... ignore this unless you're using a theme switcher
//quick function for tooltip color match
function fixToolTipColor() {
    //grab the bg color from the tooltip content - set top border of pointer to same
    $('.ui-tooltip-pointer-down-inner').each(function() {
        var bWidth = $('.ui-tooltip-pointer-down-inner').css('borderTopWidth');
        var bColor = $(this).parents('.ui-slider-tooltip').css('backgroundColor')
        $(this).css('border-top', bWidth + ' solid ' + bColor);
    });
}

function hideSelectHandle() {
    $('select, label, #handle_lock').each(function() {
        $(this).attr("hidden", true);
    });
    $("form > fieldset > div > ol").after('<div class="ui-slider-range ui-widget-header" style="left: 0%; width: 0%;"></div>')
}