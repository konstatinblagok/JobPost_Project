@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.postHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.postHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $postHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postHistory.fields.title') }}
                        </th>
                        <td>
                            {{ $postHistory->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postHistory.fields.job_post') }}
                        </th>
                        <td>
                            {{ $postHistory->job_post->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postHistory.fields.post_location') }}
                        </th>
                        <td>
                            {{ $postHistory->post_location->url ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postHistory.fields.url') }}
                        </th>
                        <td>
                            {{ $postHistory->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postHistory.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PostHistory::STATUS_SELECT[$postHistory->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-histories.index') }}">
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
            <a class="nav-link" href="#instance_clicks" role="tab" data-toggle="tab">
                {{ trans('cruds.click.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="instance_clicks">
            @includeIf('admin.postHistories.relationships.instanceClicks', ['clicks' => $postHistory->instanceClicks])
        </div>
    </div>
</div>

@endsection