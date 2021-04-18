<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobPostingRequest;
use App\Http\Requests\UpdateJobPostingRequest;
use App\Http\Resources\Admin\JobPostingResource;
use App\Models\JobPosting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobPostingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_posting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobPostingResource(JobPosting::with(['post_locations', 'team'])->get());
    }

    public function store(StoreJobPostingRequest $request)
    {       

        $jobPosting = JobPosting::create($request->all());
        $jobPosting->post_locations()->sync($request->input('post_locations', []));

        return (new JobPostingResource($jobPosting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobPostingResource($jobPosting->load(['post_locations', 'team']));
    }

    public function update(UpdateJobPostingRequest $request, JobPosting $jobPosting)
    {
        $jobPosting->update($request->all());
        $jobPosting->post_locations()->sync($request->input('post_locations', []));

        return (new JobPostingResource($jobPosting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JobPosting $jobPosting)
    {
        abort_if(Gate::denies('job_posting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPosting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
