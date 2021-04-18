@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.postLocation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.postLocation.fields.id') }}
                        </th>
                        <td>
                            {{ $postLocation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postLocation.fields.title') }}
                        </th>
                        <td>
                            {{ $postLocation->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postLocation.fields.url') }}
                        </th>
                        <td>
                            {{ $postLocation->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postLocation.fields.driver') }}
                        </th>
                        <td>
                            {{ $postLocation->driver->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-locations.index') }}">
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
            <a class="nav-link" href="#post_location_post_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.postHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#post_locations_job_postings" role="tab" data-toggle="tab">
                {{ trans('cruds.jobPosting.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="post_location_post_histories">
            @includeIf('admin.postLocations.relationships.postLocationPostHistories', ['postHistories' => $postLocation->postLocationPostHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="post_locations_job_postings">
            @includeIf('admin.postLocations.relationships.postLocationsJobPostings', ['jobPostings' => $postLocation->postLocationsJobPostings])
        </div>
    </div>
</div>

@endsection