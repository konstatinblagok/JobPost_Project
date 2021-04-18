@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.jobPosting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.job-postings.update", [$jobPosting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.jobPosting.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $jobPosting->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobPosting.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="content">{{ trans('cruds.jobPosting.fields.content') }}</label>
                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content" required>{{ old('content', $jobPosting->content) }}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobPosting.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.jobPosting.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $jobPosting->url) }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobPosting.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="post_locations">{{ trans('cruds.jobPosting.fields.post_locations') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('post_locations') ? 'is-invalid' : '' }}" name="post_locations[]" id="post_locations" multiple required>
                    @foreach($post_locations as $id => $post_locations)
                        <option value="{{ $id }}" {{ (in_array($id, old('post_locations', [])) || $jobPosting->post_locations->contains($id)) ? 'selected' : '' }}>{{ $post_locations }}</option>
                    @endforeach
                </select>
                @if($errors->has('post_locations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_locations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobPosting.fields.post_locations_helper') }}</span>
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