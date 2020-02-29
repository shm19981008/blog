<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
  //   public function rules()
  //   {
  //       return [
  //           'bname' => 'required|unique:brand|max:30|min:3',
  //           'url' => 'required|unique:brand|max:10|min:3',
  //       ];
  //   }
  //   public function messages(){return [
  //       'bname.required'=>'名字不能为空',
  //       'bname.unique'=>'名字已存在',
  //       'bname.max'=>'名字长度不超过30位',
  //       'bname.min'=>'名字长度不小于3位',
  //       'url.required'=>'网址不能为空',
  //       'url.unique'=>'网址已存在',
  //       'url.max'=>'网址长度不超过10位',
  //       'url.min'=>'网址长度不小于3位',
  //   ]; 
  // }
}
