<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Resources\Admin\DriverResource;
use App\Models\Driver;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('driver_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DriverResource(Driver::all());
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->all());

        return (new DriverResource($driver))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Driver $driver)
    {
        abort_if(Gate::denies('driver_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new DriverResource($driver);
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->all());

        return (new DriverResource($driver))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Driver $driver)
    {
        abort_if(Gate::denies('driver_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
