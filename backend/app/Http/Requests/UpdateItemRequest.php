<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'name'=>'required|max:255',
            'item_image'=>'file|mimes:jpg,png',
            'number'=>'min:1',
            'amount'=>'min:1',
            'place'=>'max:255',
            'purchase_from'=>'max:255',
            'url'=> 'max:16384',
            'memo'=> 'max:16384',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'アイテム名は必須です',
            'name.max'=>'アイテム名は255文字以内で入力して下さい',
            'item_image.file'=>'ファイルをアップロードして下さい',
            'item_image.mimes'=>'jpg,png形式のみ可能です',
            'number.min'=>'1以上の数字を入力して下さい',
            'amount.min'=>'1以上の数字を入力して下さい',
            'place.max'=>'収納場所は255文字以内で入力して下さい',
            'purchase_from.max'=>'購入場所は255文字以内で入力して下さい',
            'url.max'=>'URLは16,384文字以内で入力して下さい',
            'memo.max'=>'メモは16,384文字以内で入力して下さい',
            
        ];
    }
}
