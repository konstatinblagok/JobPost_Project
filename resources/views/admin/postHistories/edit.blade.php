@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.postHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.post-histories.update", [$postHistory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.postHistory.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $postHistory->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postHistory.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="job_post_id">{{ trans('cruds.postHistory.fields.job_post') }}</label>
                <select class="form-control select2 {{ $errors->has('job_post') ? 'is-invalid' : '' }}" name="job_post_id" id="job_post_id" required>
                    @foreach($job_posts as $id => $job_post)
                        <option value="{{ $id }}" {{ (old('job_post_id') ? old('job_post_id') : $postHistory->job_post->id ?? '') == $id ? 'selected' : '' }}>{{ $job_post }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_post'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_post') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postHistory.fields.job_post_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="post_location_id">{{ trans('cruds.postHistory.fields.post_location') }}</label>
                <select class="form-control select2 {{ $errors->has('post_location') ? 'is-invalid' : '' }}" name="post_location_id" id="post_location_id" required>
                    @foreach($post_locations as $id => $post_location)
                        <option value="{{ $id }}" {{ (old('post_location_id') ? old('post_location_id') : $postHistory->post_location->id ?? '') == $id ? 'selected' : '' }}>{{ $post_location }}</option>
                    @endforeach
                </select>
                @if($errors->has('post_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postHistory.fields.post_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="url">{{ trans('cruds.postHistory.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $postHistory->url) }}" required>
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postHistory.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.postHistory.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PostHistory::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $postHistory->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postHistory.fields.status_helper') }}</span>
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