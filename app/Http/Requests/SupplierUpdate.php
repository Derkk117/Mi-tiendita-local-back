<?php

namespace App\Http\Requests;

use Auth;
use Supplier;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class SupplierUpdate extends FormRequest
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
            'phone' => 'required|string|size:10',
            'email' => 'required|email|',
            'name' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'email.required' => 'El correo es un campo obligatorio',
            'email.email' => 'El correo debe que tener el siguiente formato correo@sacar.com',
            'name.required' => 'El nombre es un campo obligatorio',
            'phone.required' => 'El telefono de contato es un campo requerido',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()
        ], 422));   
    }
}
