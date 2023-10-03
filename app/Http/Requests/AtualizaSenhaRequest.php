<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\UserPodeAlterarSenha;



class AtualizaSenhaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        if(isAdmin()){
            $data['id']     = 'required';
        }
        $data['password']   = ['required','min:8','max:20'];
        return $data;
    }

    public function messages()
    {
        return [
            "senha.required"    => "O campo Senha é obrigatório",
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
