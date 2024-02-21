<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateDocteurRequest extends FormRequest
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
       
        {
            return [ 

                'nom' => 'required|string|min:2|max:50',
                'prenom' => 'required|string|min:2|max:50',
                'sexe' => 'required|string|in:homme,femme', 
                'age' => 'required|integer|min:18|max:100',
                'telephone' => ['nullable', 'regex:/^(77|76|75|78)+[0-9]{7}/'],
                'email' => 'required|email|unique:utilisateurs,email|regex:/^[a-zA-Z_][\w.-]*@[a-zA-Z][a-zA-Z.-]+.[a-zA-Z]{2,4}$/',
                'adresse' => 'required|string|max:255',
                'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2000', 
                'password'=> ['required', 'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/'], 
                'annee_experience' => 'required|integer|min:3|max:80',
                
            ];
        }
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
