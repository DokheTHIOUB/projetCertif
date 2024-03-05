<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreHopitalRequest extends FormRequest
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
                    'nom_hopital' => ['required','string','unique:hopitals,nom_hopital','min:4','max:255','regex:/^[a-zA-Z]+$/', ],
                    'description' => 'required|string',
                    'horaire' => 'required|string',
                    'localite_id' => 'required|exists:localites,id',
                    'image' => ['required','image', 'mimes:jpeg,png,jpg,gif']
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
