<?php

namespace App\Http\Requests\Game;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MstGameSaveRequest extends FormRequest
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
        $rules = [
            'id'            => [
                'nullable',
                'integer'
            ],
            'hardware_type' => [
                'required',
                'integer',
                Rule::in(array_keys(config('const.hardware_list')))
            ],
            'category_id'   => [
                'required',
                'integer',
                Rule::in(array_keys(config('const.category_list')))
            ],
            'link'          => [
                'url',
                'max:255'
            ],
        ];

        if($this->id) {
            // 更新時
            return array_merge($rules, [
                'title'         => [
                    'required',
                    'max:60',
                    Rule::unique('games')->ignore($this->id)
                ]
            ]);
        } else {
            // 新規追加時
            return array_merge($rules, [
                'title'         => [
                    'required',
                    'max:60',
                    'unique:games,title'
                ]
            ]);
        }
    }
}
