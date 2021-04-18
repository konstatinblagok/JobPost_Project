<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostHistoryRequest;
use App\Http\Requests\UpdatePostHistoryRequest;
use App\Http\Resources\Admin\PostHistoryResource;
use App\Models\PostHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostHistoryResource(PostHistory::with(['job_post', 'post_location', 'team'])->get());
    }

    public function store(StorePostHistoryRequest $request)
    {
        $postHistory = PostHistory::create($request->all());

        return (new PostHistoryResource($postHistory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PostHistory $postHistory)
    {
        abort_if(Gate::denies('post_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostHistoryResource($postHistory->load(['job_post', 'post_location', 'team']));
    }

    public function update(UpdatePostHistoryRequest $request, PostHistory $postHistory)
    {
        $postHistory->update($request->all());

        return (new PostHistoryResource($postHistory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PostHistory $postHistory)
    {
        abort_if(Gate::denies('post_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postHistory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
