jQuery.fn.forceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
            key == 8 ||
            key == 9 ||
            key == 13 ||
            key == 17 ||
            key == 46 ||
            key == 86 ||
            key == 110 ||
            key == 190 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105));
        });
    });
};

// JSON.stringify(form.serializeObject())
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();

    $.each(a, function()
    {
        if (o[this.name] !== undefined)
        {
            if (!o[this.name].push)
            {
                o[this.name] = [o[this.name]];
            }

            o[this.name].push(this.value || '');
        }
        else
        {
            o[this.name] = this.value || '';
        }
    });

    return o;
};

// kendo controls (multi-select and date-picker) render incorrectly when loaded from cache after clicking the back button
// !! not an ideal solution !!
$(window).on('popstate', function(event)
{
    location.reload();
});