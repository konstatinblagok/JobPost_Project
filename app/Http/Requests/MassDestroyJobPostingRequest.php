<?php

namespace App\Http\Requests;

use App\Models\JobPosting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyJobPostingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('job_posting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:job_postings,id',
        ];
    }
}
