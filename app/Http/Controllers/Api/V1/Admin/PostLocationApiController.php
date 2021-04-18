<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostLocationRequest;
use App\Http\Requests\UpdatePostLocationRequest;
use App\Http\Resources\Admin\PostLocationResource;
use App\Models\PostLocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostLocationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostLocationResource(PostLocation::with(['driver', 'team'])->get());
    }

    public function store(StorePostLocationRequest $request)
    {
        $postLocation = PostLocation::create($request->all());

        return (new PostLocationResource($postLocation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PostLocation $postLocation)
    {
        abort_if(Gate::denies('post_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostLocationResource($postLocation->load(['driver', 'team']));
    }

    public function update(UpdatePostLocationRequest $request, PostLocation $postLocation)
    {
        $postLocation->update($request->all());

        return (new PostLocationResource($postLocation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PostLocation $postLocation)
    {
        abort_if(Gate::denies('post_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postLocation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
