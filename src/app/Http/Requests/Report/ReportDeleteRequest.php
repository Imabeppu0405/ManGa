<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class ReportDeleteRequest extends FormRequest
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
            'id'            => [
                'required',
                'integer'
            ]
        ];
    }
}