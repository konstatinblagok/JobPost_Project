<?php

namespace App\Http\Requests;

use App\Models\PostHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPostHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('post_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:post_histories,id',
        ];
    }
}
