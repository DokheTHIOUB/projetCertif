<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClientRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|string|in:homme,femme',
            'age' => 'required|integer|min:18',
            'telephone' => 'required|string|max:30',
            'email' => ['required|email|unique:utilisateurs,email','regex:/^[a-zA-Z_][\w.-]*@[a-zA-Z][a-zA-Z.-]+.[a-zA-Z]{2,4}$/'],
            'adresse' => 'required|string|max:100',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2000',
            'password'=> ['required', 'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/'],
            'role_id' =>  'required|exists:roles,id',

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
