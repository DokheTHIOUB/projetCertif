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
                'diplome' => 'nullable|file|max:255',
                'specialite' => 'required|string|max:200',
                'numero_licence' => 'required|string|max:80',
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
    
    public function messages()
    {
        return [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.string' => 'Le champ nom doit être une chaîne de caractères.',
            'nom.max' => 'Le champ nom ne doit pas dépasser 50 caractères.',            
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'prenom.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le champ prénom ne doit pas dépasser 50 caractères.',
            
            'sexe.required' => 'Le champ sexe est obligatoire.',
            'sexe.string' => 'Le champ sexe doit être une chaîne de caractères.',
            'sexe.in' => 'Le champ sexe doit être soit homme, soit femme.',
            
            'age.required' => 'Le champ âge est obligatoire.',
            'age.integer' => 'Le champ âge doit être un nombre entier.',
            'age.min' => 'Le champ âge doit être d\'au moins 18 ans.',
            'age.max' => 'Le champ âge ne doit pas dépasser :100 ans.',
            
            'telephone.required' => 'Le champ téléphone est obligatoire.',
            'telephone.regex' => 'Le format du téléphone est invalide.',
            
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            
            'adresse.required' => 'Le champ adresse est obligatoire.',
            'adresse.string' => 'Le champ adresse doit être une chaîne de caractères.',
            'adresse.max' => 'Le champ adresse ne doit pas dépasser 255 caractères.',
            
            'photo_profil.required' => 'Le champ photo de profil est obligatoire.',
            'photo_profil.image' => 'Le champ photo de profil doit être une image.',
            'photo_profil.mimes' => 'Le champ photo de profil doit être au format jpeg,png,jpg,gif',
            'photo_profil.max' => 'Le champ photo de profil ne doit pas dépasser 2000 kilo-octets.',
            
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre, un chiffre et un caractère spécial, et avoir une longueur d\'au moins 8 caractères.',
            
            'diplome.required' => 'Le champ diplôme est obligatoire.',
            'diplome.string' => 'Le champ diplôme doit être une chaîne de caractères.',
            'diplome.max' => 'Le champ diplôme ne doit pas dépasser 255 caractères.',
            
            'specialite.required' => 'Le champ spécialité est obligatoire.',
            'specialite.string' => 'Le champ spécialité doit être une chaîne de caractères.',
            'specialite.max' => 'Le champ spécialité ne doit pas dépasser 200 caractères.',
            
            'numero_licence.required' => 'Le champ numéro de licence est obligatoire.',
            'numero_licence.string' => 'Le champ numéro de licence doit être une chaîne de caractères.',
            'numero_licence.max' => 'Le champ numéro de licence ne doit pas dépasser 80 caractères.',
            
            'annee_experience.required' => 'Le champ année d\'expérience est obligatoire.',
            'annee_experience.integer' => 'Le champ année d\'expérience doit être un nombre entier.',
            'annee_experience.min' => 'Le champ année d\'expérience doit être d\'au moins 3 ans.',
            'annee_experience.max' => 'Le champ année d\'expérience ne doit pas dépasser 80 ans.',
            
            'statut.required' => 'Le champ statut est obligatoire.',
            'statut.string' => 'Le champ statut doit être une chaîne de caractères.',
            'statut.in' => 'Le champ statut doit être soit disponible, soit indisponible.',
        ];
    }
    
}

