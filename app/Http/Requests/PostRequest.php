<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        $data['nome']   = 'required';
        $data['texto']  = 'required';

        if($this->method() == 'PUT'){
            $data['id']  = 'required';
        }

        return $data;
     
    }

    public function messages()
    {
        return [
            "texto.required"                => "A descrição do anúncio é obrigatória",
            "nome.required"                 => "O campo nome é obrigatório y",
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
