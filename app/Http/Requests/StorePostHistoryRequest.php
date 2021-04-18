<?php

namespace App\Http\Requests;

use App\Models\PostHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_history_create');
    }

    public function rules()
    {
        return [
            'title'            => [
                'string',
                'required',
            ],
            'job_post_id'      => [
                'required',
                'integer',
            ],
            'post_location_id' => [
                'required',
                'integer',
            ],
            'url'              => [
                'string',
                'required',
            ],
            'status'           => [
                'required',
            ],
        ];
    }
}
