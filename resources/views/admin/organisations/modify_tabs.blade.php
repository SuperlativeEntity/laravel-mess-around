<div id="organisation_spinner"></div>

<div class="col-md-12">

    <h2>@lang('organisation.claim_number'){{ $organisation->id}} - {{ $organisation->name }}</h2>@if(isset($parent))<h5><a data-pjax href="{{ route('admin.organisation.modify') }}/{{ $parent->first()->id }}"><i class="fa fa-chevron-circle-up"></i>&nbsp;{{ $parent->first()->name }}</a></h5>@endif<span class="label label-info">{{ $organisation->type->name }}</span><br>
    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#modify_basic" data-toggle="tab" aria-expanded="true"><i class="fa fa-info"></i>&nbsp;@lang('organisation.basic')</a></li>

            {{-- If the user has access and the organisation type allows capturing of buildings --}}
            @if (isset($manage_buildings) && $manage_buildings && $current_user->hasAccess(['admin.organisation.building.module']))
                <li><a href="#buildings" data-container="load_buildings" data-route="{{ route('admin.organisation.building.module',['id' => $organisation->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-home"></i>&nbsp;@lang('building.plural') @if (isset($building_count) && $building_count > 0) {{ '('.$building_count.')' }} @endif</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.organisation.individual.module']))
                <li><a href="#individuals" data-container="load_individuals" data-route="{{ route('admin.organisation.individual.module',['id' => $organisation->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-users"></i>&nbsp;@lang('individual.plural')&nbsp;@if (isset($individual_count) && $individual_count > 0) {{ '('.$individual_count.')' }} @endif</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.organisation.document.module']))
                <li><a href="#documents" data-container="load_documents" data-route="{{ route('admin.organisation.document.module',['id' => $organisation->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-file"></i>&nbsp;@lang('document.plural')</a></li>
            @endif

            @if ($current_user->hasAccess(['admin.organisation.hierarchy']))
                <li><a href="#hierarchy" data-container="load_hierarchy" data-route="{{ route('admin.organisation.hierarchy',['id' => $organisation->id]) }}" data-toggle="tab" aria-expanded="true"><i class="fa fa-level-down"></i>&nbsp;@lang('organisation.hierarchy')&nbsp;&nbsp;<i class="fa fa-level-up"></i></a></li>
            @endif

        </ul>

        <div class="tab-content">

            <div class="tab-pane fade active in" id="modify_basic">
                @include('admin.organisations.modify_basic')
            </div>

            @if ($current_user->hasAccess(['admin.organisation.building.module']))
                <div class="tab-pane fade" id="buildings">
                    <div id="load_buildings"></div>
                </div>
            @endif

            @if ($current_user->hasAccess(['admin.organisation.hierarchy']))
                <div class="tab-pane fade" id="hierarchy">
                    <div id="load_hierarchy"></div>
                </div>
            @endif

            @if ($current_user->hasAccess(['admin.organisation.individual.module']))
                <div class="tab-pane fade" id="individuals">
                    <div id="load_individuals"></div>
                </div>
            @endif

            @if ($current_user->hasAccess(['admin.organisation.document.module']))
                <div class="tab-pane fade" id="documents">
                    <div id="load_documents"></div>
                </div>
            @endif

        </div>
    </div>
</div>