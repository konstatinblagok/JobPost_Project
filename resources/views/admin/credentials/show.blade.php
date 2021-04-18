@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.credential.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.credentials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.id') }}
                        </th>
                        <td>
                            {{ $credential->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.title') }}
                        </th>
                        <td>
                            {{ $credential->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.username') }}
                        </th>
                        <td>
                            {{ $credential->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.driver') }}
                        </th>
                        <td>
                            @foreach($credential->drivers as $key => $driver)
                                <span class="label label-info">{{ $driver->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.credentials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection