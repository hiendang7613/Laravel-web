<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|min:6',
            'product_price' => 'required|integer',
        ];
    }

    public function messages(){
        return [
            'product_name.required' => ':attribute là bắt buộc',
            'product_name.min' => ':attribute không được nhỏ hơn :min ký tự',
            'product_price.required' => ':attribute bắt buộc phải nhập',
            'product_price.integer' => ':attribute phải là một số',
        ]; 
    }

    public function attributes(){
        return [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($validator->errors()->count()>0){
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }

    protected function prepareForValidation(){
        $this->merge([
            'create_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
