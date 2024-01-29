<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docteur extends Model
{
 
    protected $guarded = [
    
    ];

    // public function hopitaux(){
    //     $this->hasMany(Hopitaux::class);
    // } 



    public function utilisateur(){
            return $this->belongsTo(Utilisateur::class);
        } 

        public function specialite(){
            return $this->belongsTo(Specialite::class);
        } 

}
