<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJobPostingRequest;
use App\Http\Requests\StoreJobPostingRequest;
use App\Http\Requests\UpdateJobPostingRequest;
use App\Models\JobPosting;
use App\Models\PostHistory;
use App\Models\PostLocation;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('job_posting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JobPosting::with(['post_locations', 'team'])->select(sprintf('%s.*', (new JobPosting)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'job_posting_show';
                $editGate      = 'job_posting_edit';
                $deleteGate    = 'job_posting_delete';
                $crudRoutePart = 'job-postings';

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
            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : "";
            });
            $table->editColumn('url', function ($row) {
                return $row->shorten_url ? $row->shorten_url : "";
            });
            $table->editColumn('post_locations', function ($row) {
                $labels = [];

                foreach ($row->post_locations as $post_location) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $post_location->url);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'post_locations']);

            return $table->make(true);
        }

        $post_locations = PostLocation::get();
        $teams          = Team::get();

        return view('admin.jobPostings.index', compact('post_locations', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_posting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post_locations = PostLocation::all()->pluck('url', 'id');

        return view('admin.jobPostings.create', compact('post_locations'));
    }

    public function store(StoreJobPostingRequest $request)
    {

        $url_random = Str::random(16);
        $jobPosting = JobPosting::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'url' => $request->input('url'),
            'shorten_url' => "http://" . $request->getHttpHost() ."/shorten/". $url_random
        ]);
        
        $jobPosting->post_locations()->sync($request->input('post_locations', []));
        
        $jobHistory = new PostHistory();
        
        $jobHistory -> job_post() -> associate($jobPosting);
        $jobHistory->status = 'Successful';
        $jobHistory->title = $jobPosting->title;
        $jobHistory->url = $jobPosting->url;
        $jobHistory->post_location_id = $request->post_locations[0];
        $jobHistory->save();


        return redirect()->route('admin.job-postings.index');
    }

    public function edit(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post_locations = PostLocation::all()->pluck('url', 'id');

        $jobPosting->load('post_locations', 'team');

        return view('admin.jobPostings.edit', compact('post_locations', 'jobPosting'));
    }

    public function update(UpdateJobPostingRequest $request, JobPosting $jobPosting)
    {
        $jobPosting->update($request->all());
        $jobPosting->post_locations()->sync($request->input('post_locations', []));

        return redirect()->route('admin.job-postings.index');
    }

    public function show(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPosting->load('post_locations', 'team', 'jobPostPostHistories');

        return view('admin.jobPostings.show', compact('jobPosting'));
    }

    public function destroy(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPosting->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobPostingRequest $request)
    {
        JobPosting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
