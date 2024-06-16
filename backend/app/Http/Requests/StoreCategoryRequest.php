<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'memo'=> 'max:16384',
            'rule1'=> 'max:16384',
            'rule2'=> 'max:16384',
            'rule3'=> 'max:16384',
            'rule4'=> 'max:16384',
            'rule5'=> 'max:16384',
        ];
    }
    public function messages()
    {
    return [
            'name.required' => 'カテゴリ名は必須です',
            'name.max'=>'カテゴリ名は255文字以内で入力して下さい',
            'memo.max' => 'メモは16,384文字以内で入力して下さい',
            'rule1.max' => 'ルールは16,384文字以内で入力して下さい',
            'rule2.max' => 'ルールは16,384文字以内で入力して下さい',
            'rule3.max' => 'ルールは16,384文字以内で入力して下さい',
            'rule4.max' => 'ルールは16,384文字以内で入力して下さい',
            'rule5.max' => 'ルールは16,384文字以内で入力して下さい',
        ];
    }
}
