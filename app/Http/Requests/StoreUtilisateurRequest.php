<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUtilisateurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'regex:/^[a-z_][\w.-]*@[a-zA-Z][a-zA-Z.-]+\.[a-zA-Z]{2,4}$/'],
            'password'=> ['required', 'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/'],
        ];
     }

     public function failedValidation(Validator $validator ){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'status_code'=>422,
            'error'=>true,
            'message'=>'erreur de validation',
            'errorList'=>$validator->errors(),
        ]));
    }

}
