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
}
