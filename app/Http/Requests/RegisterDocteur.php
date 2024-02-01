<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterDocteur extends FormRequest
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

                'nom' => 'required|string|max:50',
                'prenom' => 'required|string|max:50',
                'sexe' => 'required|string|in:homme,femme', 
                'age' => 'required|integer|min:18|max:100',
                'telephone' => ['nullable', 'regex:/^(77|76|75|78)+[0-9]{7}/'],
                'email' => 'required|email|unique:utilisateurs,email',
                'adresse' => 'required|string|max:255',
                'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2000', 
                'password'=> ['required', 'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/'],
                'diplome' => 'nullable|file|',
                'numero_licence' => 'required|string|max:80',
                'annee_experience' => 'required|integer|min:3|max:80',
                'specialite_id' => 'required|exists:specialite,id',
                'role_id' => 'required|exists:roles,id',
                
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

