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
            'email' => 'required|email|unique:utilisateurs,email',
            'adresse' => 'required|string|max:100',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2000',
            'password'=> ['required', 'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/'],
            'role_id' =>  'required|exists:roles,id',

        ];
    } 
 //failedValidation: Cette méthode est appelée automatiquement lorsque la validation échoue.
 //Vous la surchargez pour définir votre propre logique de gestion des erreurs.
// $validator: Il s'agit de l'instance du validateur qui a échoué. Vous l'utilisez pour obtenir les détails des erreurs de validation.
// throw new HttpResponseException(...): Cela lance une exception HTTP, interrompant le processus de la requête normale. 
// L'exception est ensuite capturée par Laravel et utilisée pour générer une réponse HTTP.
// response()->json([...]): Vous créez une réponse JSON avec les détails de l'erreur de validation.
// Les éléments de la réponse incluent le succès, le code d'état, un indicateur d'erreur, un message d'erreur personnalisé et 
// la liste des erreurs retournée par le validateur.

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
