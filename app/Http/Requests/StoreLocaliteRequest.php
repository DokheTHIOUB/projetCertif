<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLocaliteRequest extends FormRequest
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
            'nom_localite' => 'required|string|max:255',  // Exemple de règle : obligatoire, chaîne de caractères, maximum de 255 caractères
            'code_postal' => 'required|string|max:10',    // Ajoutez des règles appropriées pour 'code_postal'
            'region_id' => 'required|exists:regions,id',   // Exemple : obligatoire, doit exister dans la table 'regions' sous la colonne 'id'
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
