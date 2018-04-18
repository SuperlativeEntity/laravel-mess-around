@if (isset($hierarchy) && count($hierarchy) > 0)
    <ul>
    @foreach ($hierarchy as $node)
        <li>
            <a data-pjax href="{{ route('admin.organisation.modify') }}/{{ $node->id }}">

                @if (isset($organisation) && $organisation->id === $node->id)
                    {!! '<strong>' !!}
                @endif

                {{ $node->name }}

                @if (isset($organisation) && $organisation->id === $node->id)
                        {!! '</strong>' !!}
                @endif

            </a><span class="label label-success">{{ $node->type->name }}</span>


            @if ($node->buildings->count() > 0 && in_array($node->organisation_type_id,config('organisation.has_buildings'))) <span class="label label-info">@lang('building.plural') ({{ $node->buildings->count() }}) </span>&nbsp;@endif
            @if ($node->individuals(config('role.claimant'))->count() > 0) <span class="label label-info">@lang('individual.plural') ({{ $node->individuals(config('role.member'))->count() }}) </span>&nbsp;@endif

        </li>

            <br>
     @endforeach
    </ul>
@endif