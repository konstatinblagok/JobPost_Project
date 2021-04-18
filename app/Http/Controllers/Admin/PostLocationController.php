<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPostLocationRequest;
use App\Http\Requests\StorePostLocationRequest;
use App\Http\Requests\UpdatePostLocationRequest;
use App\Models\Driver;
use App\Models\PostLocation;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PostLocationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('post_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PostLocation::with(['driver', 'team'])->select(sprintf('%s.*', (new PostLocation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'post_location_show';
                $editGate      = 'post_location_edit';
                $deleteGate    = 'post_location_delete';
                $crudRoutePart = 'post-locations';

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
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : "";
            });
            $table->addColumn('driver_name', function ($row) {
                return $row->driver ? $row->driver->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'driver']);

            return $table->make(true);
        }

        $drivers = Driver::get();
        $teams   = Team::get();

        return view('admin.postLocations.index', compact('drivers', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.postLocations.create', compact('drivers'));
    }

    public function store(StorePostLocationRequest $request)
    {
        $postLocation = PostLocation::create($request->all());

        return redirect()->route('admin.post-locations.index');
    }

    public function edit(PostLocation $postLocation)
    {
        abort_if(Gate::denies('post_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drivers = Driver::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postLocation->load('driver', 'team');

        return view('admin.postLocations.edit', compact('drivers', 'postLocation'));
    }

    public function update(UpdatePostLocationRequest $request, PostLocation $postLocation)
    {
        $postLocation->update($request->all());

        return redirect()->route('admin.post-locations.index');
    }

    public function show(PostLocation $postLocation)
    {
        abort_if(Gate::denies('post_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postLocation->load('driver', 'team', 'postLocationPostHistories', 'postLocationsJobPostings');

        return view('admin.postLocations.show', compact('postLocation'));
    }

    public function destroy(PostLocation $postLocation)
    {
        abort_if(Gate::denies('post_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postLocation->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostLocationRequest $request)
    {
        PostLocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
