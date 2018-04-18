<?php

// {!! Html::list_icon('white') !!}
Html::macro('list_icon', function($colour)
{
    return "<i style=\"color:{$colour}\" class=\"fa fa-2x fa-list\"></i>";
});