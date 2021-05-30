<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class CutoffStore extends FormRequest
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
            'initial_date' => 'required',
            'final_date' => 'required',
            'total' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'initial_date' => 'Initial date is a required field',
            'final_date.required' => 'Final date is a required field',
            'total.required' => 'Total is a required field.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}