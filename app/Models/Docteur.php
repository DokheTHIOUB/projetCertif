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
        'statut', 
        'utilisateur_id',
    ];

    // public function hopitaux(){
    //     $this->hasMany(Hopitaux::class);
    // } 



    public function utilisateur(){
            return $this->belongsTo(Utilisateur::class);
        } 

}
