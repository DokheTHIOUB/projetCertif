<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hopitaux extends Model
{
    protected $guarded = [
    
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
