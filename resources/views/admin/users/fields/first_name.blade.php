{!! Html::input(['input_group' => true,'label' => trans('user.first_name'),'name' => 'first_name','type' => 'text','value' => isset($user->first_name) ? $user->first_name : null,'placeholder' => trans('user.first_name')]) !!}