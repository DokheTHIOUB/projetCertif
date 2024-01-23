<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|string|in:homme,femme',
            'age' => 'required|integer|min:18',
            'telephone' => 'required|string|max:30',
            'email' => 'required|email|unique:utilisateurs,email',
            'adresse' => 'required|string|max:100',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2000',
            'password' => 'required|string|min:8'
        ];
    } 

    public function messages()
    {
        return [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.string' => 'Le champ nom doit être une chaîne de caractères.',
            'nom.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
            
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'prenom.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le champ prénom ne doit pas dépasser 255 caractères.',
            
            'sexe.required' => 'Le champ sexe est obligatoire.',
            'sexe.string' => 'Le champ sexe doit être une chaîne de caractères.',
            'sexe.in' => 'Le champ sexe doit être soit homme, soit femme.',
            
            'age.required' => 'Le champ âge est obligatoire.',
            'age.integer' => 'Le champ âge doit être un nombre entier.',
            'age.min' => 'Le champ âge doit être d\'au moins 18ans.',
            
            'telephone.required' => 'Le champ téléphone est obligatoire.',
            'telephone.string' => 'Le champ téléphone doit être une chaîne de caractères.',
            'telephone.max' => 'Le champ téléphone ne doit pas dépasser 30 caractères.',
            
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            
            'adresse.required' => 'Le champ adresse est obligatoire.',
            'adresse.string' => 'Le champ adresse doit être une chaîne de caractères.',
            'adresse.max' => 'Le champ adresse ne doit pas dépasser 100 caractères.',
            
            'photo_profil.image' => 'Le champ photo de profil doit être une image.',
            'photo_profil.mimes' => 'Le champ photo de profil doit être au format :mimes.',
            'photo_profil.max' => 'Le champ photo de profil ne doit pas dépasser 2000 kilo-octets.',
            
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.string' => 'Le champ mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le champ mot de passe doit avoir au moins 8 caractères.',
        ];
    }
}
