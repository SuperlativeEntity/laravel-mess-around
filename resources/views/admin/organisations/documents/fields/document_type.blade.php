{!! Form::label('document_type_id', trans('document.document_type'), ['class' => 'control-label"','id' => 'document_type_id_label']) !!} {!! Html::required() !!}<br>
{!! Form::select('document_type_id', [],null,['id' => 'document_type_id','tabindex'=>500]) !!}