@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.click.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clicks.update", [$click->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="instance_id">{{ trans('cruds.click.fields.instance') }}</label>
                <select class="form-control select2 {{ $errors->has('instance') ? 'is-invalid' : '' }}" name="instance_id" id="instance_id">
                    @foreach($instances as $id => $instance)
                        <option value="{{ $id }}" {{ (old('instance_id') ? old('instance_id') : $click->instance->id ?? '') == $id ? 'selected' : '' }}>{{ $instance }}</option>
                    @endforeach
                </select>
                @if($errors->has('instance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.click.fields.instance_helper') }}</span>
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