<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class DeliveryStore extends FormRequest
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
            'estimated_date' => 'required',
            'delivered_date' => 'required',
            'sale_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'estimated.required' => 'Estimated date is a required field',
            'delivered_date.required' => 'Delivered date is a required field',
            'sale_id.required' => 'Sale_id is a required field.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}