<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\UserEmailAutorizado;


class SolicitarNovaSenhaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $data['email']      = ['required','email', new UserEmailAutorizado];
        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'msg' => $validator->errors()->messages()['email'][0],
            'tipo' => 'alert',
            'status' => true
        ], 422));
    }
}
