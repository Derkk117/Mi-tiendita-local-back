<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class AddressUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge(['email' => strtolower($this->email)]);
    }

    public function rules()
    {
        return [
            'street' => 'required',
            'external_street' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'postal_code' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'street' => 'Street is a requiered field',
            'external_street' => 'External number is a requiered field',
            'postal_code' => 'PC is a requiered field',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()
        ], 422));   
    }
}