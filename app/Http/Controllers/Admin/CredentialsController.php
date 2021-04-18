<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCredentialRequest;
use App\Http\Requests\StoreCredentialRequest;
use App\Http\Requests\UpdateCredentialRequest;
use App\Models\Credential;
use App\Models\Driver;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CredentialsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('credential_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Credential::with(['drivers', 'team'])->select(sprintf('%s.*', (new Credential)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'credential_show';
                $editGate      = 'credential_edit';
                $deleteGate    = 'credential_delete';
                $crudRoutePart = 'credentials';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : "";
            });
            $table->editColumn('driver', function ($row) {
                $labels = [];

                foreach ($row->drivers as $driver) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $driver->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'driver']);

            return $table->make(true);
        }

        $drivers = Driver::get();
        $teams   = Team::get();

        return view('admin.credentials.index', compact('drivers', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('credential_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id');

        return view('admin.credentials.create', compact('drivers'));
    }

    public function store(StoreCredentialRequest $request)
    {
        $credential = Credential::create($request->all());
        $credential->drivers()->sync($request->input('drivers', []));

        return redirect()->route('admin.credentials.index');
    }

    public function edit(Credential $credential)
    {
        abort_if(Gate::denies('credential_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id');

        $credential->load('drivers', 'team');

        return view('admin.credentials.edit', compact('drivers', 'credential'));
    }

    public function update(UpdateCredentialRequest $request, Credential $credential)
    {
        $credential->update($request->all());
        $credential->drivers()->sync($request->input('drivers', []));

        return redirect()->route('admin.credentials.index');
    }

    public function show(Credential $credential)
    {
        abort_if(Gate::denies('credential_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credential->load('drivers', 'team');

        return view('admin.credentials.show', compact('credential'));
    }

    public function destroy(Credential $credential)
    {
        abort_if(Gate::denies('credential_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credential->delete();

        return back();
    }

    public function massDestroy(MassDestroyCredentialRequest $request)
    {
        Credential::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
