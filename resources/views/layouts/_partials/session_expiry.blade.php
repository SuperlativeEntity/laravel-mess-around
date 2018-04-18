var idleTime = 0;

var timer_started = $('#hourglass-user-active');
var timer_idle    = $('#hourglass-user-idle');
var timer_expired = $('#hourglass-user-session-expired');

$(document).ready(function ()
{
    setInterval(timerIncrement, {{ config('system.idle_increment') }}); // increment every minute
    
    $(this).mousemove(function (e)
    {
        timer_started.show();
        timer_idle.hide();
        timer_expired.hide();

        idleTime = 0;
    });

    $(this).keypress(function (e)
    {
        timer_started.show();
        timer_idle.hide();
        timer_expired.hide();

        idleTime = 0;
    });
});

function timerIncrement()
{
    idleTime++;

    timer_started.hide();
    timer_idle.show();
    timer_expired.hide();

    if (idleTime >= {{ config('system.session_expiry') }})
    {
        alert('{{ trans('login.session_expired',['minutes'=>config('system.session_expiry')]) }}');
        window.location = '{{ route('auth.login') }}';
    }
}