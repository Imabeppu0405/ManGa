<?php

namespace App\Http\Requests\Game;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MstGameSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
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
            'memo'          => [
                'max:255'
            ],
        ];

        // 更新時
        if($this->id) {
            return array_merge($rules, [
                'title'         => [
                    'required',
                    'max:60',
                    Rule::unique('games')->ignore($this->id)
                ]
            ]);
        } else {
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
