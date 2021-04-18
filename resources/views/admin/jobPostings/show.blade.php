@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jobPosting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-postings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.id') }}
                        </th>
                        <td>
                            {{ $jobPosting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.title') }}
                        </th>
                        <td>
                            {{ $jobPosting->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.content') }}
                        </th>
                        <td>
                            {{ $jobPosting->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.url') }}
                        </th>
                        <td>
                            {{ $jobPosting->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosting.fields.post_locations') }}
                        </th>
                        <td>
                            @foreach($jobPosting->post_locations as $key => $post_locations)
                                <span class="label label-info">{{ $post_locations->url }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-postings.index') }}">
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
            <a class="nav-link" href="#job_post_post_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.postHistory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="job_post_post_histories">
            @includeIf('admin.jobPostings.relationships.jobPostPostHistories', ['postHistories' => $jobPosting->jobPostPostHistories])
        </div>
    </div>
</div>

@endsection