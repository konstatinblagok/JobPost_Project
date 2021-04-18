<?php

namespace App\Http\Requests;

use App\Models\JobPosting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobPostingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_posting_edit');
    }

    public function rules()
    {
        return [
            'title'            => [
                'string',
                'required',
            ],
            'content'          => [
                'required',
            ],
            'url'              => [
                'string',
                'nullable',
            ],
            'post_locations.*' => [
                'integer',
            ],
            'post_locations'   => [
                'required',
                'array',
            ],
        ];
    }
}
