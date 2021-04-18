<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPostHistoryRequest;
use App\Http\Requests\StorePostHistoryRequest;
use App\Http\Requests\UpdatePostHistoryRequest;
use App\Models\JobPosting;
use App\Models\PostHistory;
use App\Models\PostLocation;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostHistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postHistories = PostHistory::with(['job_post', 'post_location', 'team'])->get();

        $job_postings = JobPosting::get();

        $post_locations = PostLocation::get();

        $teams = Team::get();

        return view('admin.postHistories.index', compact('postHistories', 'job_postings', 'post_locations', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_posts = JobPosting::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $post_locations = PostLocation::all()->pluck('url', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.postHistories.create', compact('job_posts', 'post_locations'));
    }

    public function store(StorePostHistoryRequest $request)
    {
        $postHistory = PostHistory::create($request->all());

        return redirect()->route('admin.post-histories.index');
    }

    public function edit(PostHistory $postHistory)
    {
        abort_if(Gate::denies('post_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_posts = JobPosting::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $post_locations = PostLocation::all()->pluck('url', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postHistory->load('job_post', 'post_location', 'team');

        return view('admin.postHistories.edit', compact('job_posts', 'post_locations', 'postHistory'));
    }

    public function update(UpdatePostHistoryRequest $request, PostHistory $postHistory)
    {
        $postHistory->update($request->all());

        return redirect()->route('admin.post-histories.index');
    }

    public function show(PostHistory $postHistory)
    {
        abort_if(Gate::denies('post_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postHistory->load('job_post', 'post_location', 'team', 'instanceClicks');

        return view('admin.postHistories.show', compact('postHistory'));
    }

    public function destroy(PostHistory $postHistory)
    {
        abort_if(Gate::denies('post_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postHistory->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostHistoryRequest $request)
    {
        PostHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
