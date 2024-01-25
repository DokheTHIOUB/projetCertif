<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hopitaux extends Model
{
    protected $fillable = [
        'hopitaux_id',
        'nom_hopital',
        'description',
        'lattitude',
        'longitude',
        'horaire', 
        'localite_id',

    ]; 

    public function docteur(){
        $this->hasMany(Docteur::class);
    } 

    public function localite(){
        $this->belongsTo(localite::class);
    } 
    
    public function Avis(){
        $this->hasMany(Avis::class);
    } 
}
