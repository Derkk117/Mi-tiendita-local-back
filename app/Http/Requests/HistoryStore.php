<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException; 

class HistoryStore extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function prepareForValidation(){
        //$this->merge(['id' => '1']);
    }

    public function rules()
    {
        return [
            'description' => 'required',
            'id_user' => 'required',
            'date' => 'required',
            'time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Description is a required field.',
            'id_user.required' => 'id user is a required field.',
            'date.required' => 'Date is a required field.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }
}