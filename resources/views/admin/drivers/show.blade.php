@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.driver.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drivers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.driver.fields.id') }}
                        </th>
                        <td>
                            {{ $driver->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.driver.fields.name') }}
                        </th>
                        <td>
                            {{ $driver->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drivers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#driver_post_locations" role="tab" data-toggle="tab">
                {{ trans('cruds.postLocation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#driver_credentials" role="tab" data-toggle="tab">
                {{ trans('cruds.credential.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="driver_post_locations">
            @includeIf('admin.drivers.relationships.driverPostLocations', ['postLocations' => $driver->driverPostLocations])
        </div>
        <div class="tab-pane" role="tabpanel" id="driver_credentials">
            @includeIf('admin.drivers.relationships.driverCredentials', ['credentials' => $driver->driverCredentials])
        </div>
    </div>
</div>

@endsection