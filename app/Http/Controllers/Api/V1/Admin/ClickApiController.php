<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClickRequest;
use App\Http\Requests\UpdateClickRequest;
use App\Http\Resources\Admin\ClickResource;
use App\Models\Click;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClickApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('click_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClickResource(Click::with(['instance'])->get());
    }

    public function store(StoreClickRequest $request)
    {
        $click = Click::create($request->all());

        return (new ClickResource($click))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Click $click)
    {
        abort_if(Gate::denies('click_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClickResource($click->load(['instance']));
    }

    public function update(UpdateClickRequest $request, Click $click)
    {
        $click->update($request->all());

        return (new ClickResource($click))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Click $click)
    {
        abort_if(Gate::denies('click_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $click->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
