<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class CutoffUpdate extends FormRequest
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
            'initial_date' => 'required',
            'final_date' => 'required',
            'total' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'email.required' => 'El correo es un campo obligatorio',
            'email.email' => 'El correo debe que tener el siguiente formato correo@sacar.com',
            'inital_date' => 'La fecha inicial se debe de ingresar',
            'final_date' => 'La fecha inicial se debe de ingresar',
            'total' => 'El total se debe de ingresar'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()
        ], 422));   
    }
}