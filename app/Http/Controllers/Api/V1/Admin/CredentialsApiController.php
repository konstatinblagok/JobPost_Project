<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCredentialRequest;
use App\Http\Requests\UpdateCredentialRequest;
use App\Http\Resources\Admin\CredentialResource;
use App\Models\Credential;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CredentialsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('credential_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CredentialResource(Credential::with(['drivers', 'team'])->get());
    }

    public function store(StoreCredentialRequest $request)
    {
        $credential = Credential::create($request->all());
        $credential->drivers()->sync($request->input('drivers', []));

        return (new CredentialResource($credential))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Credential $credential)
    {
        abort_if(Gate::denies('credential_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CredentialResource($credential->load(['drivers', 'team']));
    }

    public function update(UpdateCredentialRequest $request, Credential $credential)
    {
        $credential->update($request->all());
        $credential->drivers()->sync($request->input('drivers', []));

        return (new CredentialResource($credential))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Credential $credential)
    {
        abort_if(Gate::denies('credential_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credential->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
