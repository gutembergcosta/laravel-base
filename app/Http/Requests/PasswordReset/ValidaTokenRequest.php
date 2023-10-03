<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\ValidaTokenRequestSenha;


class ValidaTokenRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $data['token']      = ['required', new ValidaTokenRequestSenha];
        $data['password']   = 'required|min:8|max:20';
        return $data;
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
