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
            'external_number' => 'required',
            'zip_code' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'street.required' => 'Street is a required field',
            'external_number.required' => 'External number is a required field.',
            'zip_code.required' => 'Zip code is a required field.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}
