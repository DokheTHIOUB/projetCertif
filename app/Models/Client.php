<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [
    
    ];

    public function utilisateur(){

            return $this->belongsTo(Utilisateur::class);} 

     public function Avis(){
                $this->hasMany(Avis::class);
            }
}
