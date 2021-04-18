<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClickRequest;
use App\Http\Requests\StoreClickRequest;
use App\Http\Requests\UpdateClickRequest;
use App\Models\Click;
use App\Models\PostHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClickController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('click_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clicks = Click::with(['instance'])->get();

        return view('admin.clicks.index', compact('clicks'));
    }

    public function create()
    {
        abort_if(Gate::denies('click_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instances = PostHistory::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clicks.create', compact('instances'));
    }

    public function store(StoreClickRequest $request)
    {
        $click = Click::create($request->all());

        return redirect()->route('admin.clicks.index');
    }

    public function edit(Click $click)
    {
        abort_if(Gate::denies('click_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instances = PostHistory::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $click->load('instance');

        return view('admin.clicks.edit', compact('instances', 'click'));
    }

    public function update(UpdateClickRequest $request, Click $click)
    {
        $click->update($request->all());

        return redirect()->route('admin.clicks.index');
    }

    public function show(Click $click)
    {
        abort_if(Gate::denies('click_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $click->load('instance');

        return view('admin.clicks.show', compact('click'));
    }

    public function destroy(Click $click)
    {
        abort_if(Gate::denies('click_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $click->delete();

        return back();
    }

    public function massDestroy(MassDestroyClickRequest $request)
    {
        Click::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
