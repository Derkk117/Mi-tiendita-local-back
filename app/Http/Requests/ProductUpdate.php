<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class ProductUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge(['id' => '1']);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'cost' => 'required',
            'stock' => 'required',
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is a required field.',
            'price.required' => 'Price is a required field.',
            'cost.required' => 'Cost is a required field.',
            'stock.required' => 'stock is a required field.',
            'category.required' => 'category is a required field.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}
