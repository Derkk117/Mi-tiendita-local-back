<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreStore extends FormRequest{

    public function authorize(){
        return true;
    }

    public function prepareForValidation(){
        $this->merge(['id' => '1']);
    }

    public function rules(){
        return [
            'name' => 'required',
            'address' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'The name is required',
            'address.required' => 'The address is required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}

?>