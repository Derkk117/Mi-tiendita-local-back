<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class AddressStore extends FormRequest
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
            'street' => 'required',
            'external_street' => 'required',
            'postal_code' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'street.required' => 'Products is a required field. Almost select one product',
            'external_street.required' => 'payment_method is a required field.',
            'postal_code.required' => 'PC is a required field.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}
