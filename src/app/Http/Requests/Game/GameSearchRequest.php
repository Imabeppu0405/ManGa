<?php

namespace App\Http\Requests\Game;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GameSearchRequest extends FormRequest
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
            'title'         => [
                'nullable',
                'max:60',
            ],
            'hardware_type' => [
                'nullable',
                'integer',
                Rule::in(array_keys(config('const.category_list')))
            ],
            'category_id'   => [
                'nullable',
                'integer',
                Rule::in(array_keys(config('const.category_list')))
            ],
        ];
    }
}