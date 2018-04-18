<?php

// {!! Html::user_heading($user) !!}
Html::macro('user_heading', function($user)
{
    return trans('user.modify_user').' : '.$user->first_name.' '.$user->last_name;
});