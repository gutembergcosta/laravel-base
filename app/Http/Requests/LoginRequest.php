<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        $data['email']   = 'required';
        $data['password']  = 'required';

        return $data;
     
    }

    public function messages()
    {
        return [
            "nome.required"                 => "O campo Email é obrigatório",
            "senha.required"                => "O campo Senha é obrigatório",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'tipo' => 'modal',
            'status' => true
        ], 422));
    }
}
