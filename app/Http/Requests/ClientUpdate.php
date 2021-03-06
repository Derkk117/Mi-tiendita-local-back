<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;  


class ClientUpdate extends FormRequest
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
            'email' => 'required|email|'.Rule::unique('clients')->ignore(Auth::client()->id, 'id')
        ];
    }

    public function mesagges()
    {
        return [
            'email.required' => 'El correo es un campo obligatorio',
            'email.email' => 'El correo debe que tener el siguiente formato correo@sacar.com',
            'email.unique' => 'El correo ya se encuentra registrado, intente con otro',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()
        ], 422));   
    }
}
