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
        $this->merge(['id' => '1']);
    }

    public function rules()
    {
        return [
            'street' => 'required',
            'external_number' => 'required',
            'neighborhood' => 'required',
            'zip_code' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'street' => 'Street is a requiered field',
            'external_number' => 'External number is a requiered field',
            'zip code' => 'zip code is a requiered field',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()
        ], 422));   
    }
}