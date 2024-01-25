<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'utilisateur_id'
    ];

    public function utilisateur(){

            return $this->belongsTo(Utilisateur::class);} 

     public function Avis(){
                $this->hasMany(Avis::class);
            }
}
