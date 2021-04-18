@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.credential.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.credentials.update", [$credential->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.credential.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $credential->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.credential.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $credential->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('cruds.credential.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="drivers">{{ trans('cruds.credential.fields.driver') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('drivers') ? 'is-invalid' : '' }}" name="drivers[]" id="drivers" multiple required>
                    @foreach($drivers as $id => $driver)
                        <option value="{{ $id }}" {{ (in_array($id, old('drivers', [])) || $credential->drivers->contains($id)) ? 'selected' : '' }}>{{ $driver }}</option>
                    @endforeach
                </select>
                @if($errors->has('drivers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('drivers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credential.fields.driver_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection