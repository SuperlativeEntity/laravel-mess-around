<div id="individual_spinner"></div>

<div class="col-md-12">

    <h2>{{ $individual->first_name.' '.$individual->last_name }}</h2>
    <span class="label label-info">{{ $individual->id_number }}</span>
    <span class="label label-info">{{ $individual->email }}</span>
    <span class="label label-info">{{ $individual->mobile }}</span>

    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#modify_basic" data-toggle="tab" aria-expanded="true"><i class="fa fa-info"></i>&nbsp;@lang('individual.basic')</a></li>

            @if ($current_user->hasAccess(['admin.individual.relations']))
                <li><a href="#individual_relations" data-container="load_individual_relations" data-route="{{ route('admin.individual.relations',['id' => $individual->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-users"></i>Claims</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.individual.note.module']))
                <li><a href="#individual_notes" data-container="load_individual_notes" data-route="{{ route('admin.individual.note.module',['id' => $individual->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-comment"></i>Notes</a></li>
            @endif
        </ul>

        <div class="tab-content">

            <div class="tab-pane fade active in" id="modify_basic">
                @include('admin.individuals.modify_basic')
            </div>

            @if ($current_user->hasAccess(['admin.individual.relations']))
                <div class="tab-pane fade" id="individual_relations">
                    <div id="load_individual_relations"></div>
                </div>
            @endif

            @if ($current_user->hasAccess(['admin.individual.note.module']))
                <div class="tab-pane fade" id="individual_notes">
                    <div id="load_individual_notes"></div>
                </div>
            @endif

        </div>
    </div>
</div>