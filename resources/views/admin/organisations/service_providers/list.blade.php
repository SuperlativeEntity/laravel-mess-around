<h2>@lang('service_provider.list')</h2>

@if (isset($service_providers))
    <table class="table">
        <thead>
            <tr>
                <th>@lang('individual.first_name')</th>
                <th>@lang('individual.last_name')</th>
                <th>@lang('individual.id_number')</th>
                <th>@lang('individual.mobile')</th>
                <th>@lang('individual.email')</th>
                <th>@lang('service_provider.director_of')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service_providers as $service_provider)
                <tr>
                <td>{{ $service_provider->first_name }}</td>
                <td>{{ $service_provider->last_name }}</td>
                <td>{{ $service_provider->id_number }}</td>
                <td>{{ $service_provider->mobile }}</td>
                <td><a href="mailto:{{ $service_provider->email }}">{{ $service_provider->email }}</a></td>
                <td>
                    @if ($service_provider->organisationsByRole(config('role.director'))->count())
                        @foreach ($service_provider->organisationsByRole(config('role.director'))->get() as $organisation)
                             <span class="label label-success">{{ $organisation->name }}</span><br><br>
                        @endforeach
                    @endif
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif