<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ItemRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        $data['nome']   = 'required';
        $data['ref']    = 'required';
        $data['texto']  = 'required';

        if($this->method() == 'PUT'){
            $data['id']  = 'required';
        }
        

        return $data;
     
    }

    public function messages()
    {
        return [
            "texto.required"                => "A descrição é obrigatória",
            "nome.required"                 => "O campo nome é obrigatório x",
        ];
    }

    

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'tipo' => 'html',
            'status' => true
        ], 422));
    }
}
