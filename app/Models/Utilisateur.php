<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'age',
        'telephone',
        'role',
        'email', 
        'adresse',
        'photo_profil',
        'email_verified_at',
        'remember_token',
    ]; 

    public function docteur(){
        return $this->hasOne(Docteur::class);
    } 

    public function client(){
        return $this->hasOne(Client::class);
    } 
}
