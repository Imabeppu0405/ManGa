<?php

namespace App\Http\Requests\Report;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ReportSaveRequest extends FormRequest
{
    /**
     * ユーザが認証済みの場合のみにするか
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルールの設定
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'report_id' => [
                'nullable',
                'integer'
            ],
            'game_id'   => [
                'required',
                'integer'
            ],
            'status_id' => [
                'required',
                'integer',
                Rule::in(array_keys(config('const.status_list')))
            ],
            'start_at'  => [
                'nullable',
                'date',
            ],
            'end_at'  => [
                'nullable',
                'date',
                'after:start_at'
            ],
            'memo'      => [
                'nullable',
                'max:255'
            ],
        ];
    }
}