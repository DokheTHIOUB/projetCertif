<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docteur extends Model
{
 
    protected $fillable = [
        'diplome',
        'specialite',
        'numero_licence',
        'annee_experience',
        'hopitaux_frequente',
        'statut', 
        'utilisateur_id',
    ];

    public function utilisateur(){
            return $this->belongsTo(Utilisateur::class);
        } 

}
