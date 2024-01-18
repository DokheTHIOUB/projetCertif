<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'password',
        'utilisateur_id',
    ];

    public function client(){

            return $this->belongsTo(Utilisateur::class);} 

    public function commentaire(){
       
        return $this->belongsTo(Commentaire::class); }
}
