<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\EmailCadastrado;


class CadastroRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $data['name']       = 'required';
        $data['email']      = ['required','email', new EmailCadastrado];

        if($this->method() == 'POST'){
            $data['password']   = 'required|min:8|max:20';
        }

        if($this->method() == 'PUT'){
            if(isAdmin()){
                $data['id']     = 'required';
            }

            //$data['status'] = 'required';
        }
        return $data;
    }

    public function messages()
    {
        return [
            "name.required"     => "O campo Nome é obrigatório z",
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
