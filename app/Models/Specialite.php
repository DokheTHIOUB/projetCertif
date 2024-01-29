<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    protected $guarded = [
    
    ];
    public function Docteur(){
        $this->hasMany(Docteur::class);
    } 

   
}
