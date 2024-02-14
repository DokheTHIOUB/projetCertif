<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class hopital extends Model
{
    use HasFactory;
    protected $guarded = [
    
    ];

    public function docteur(){
        $this->hasMany(Docteur::class);
    } 

    public function localite(){
        $this->belongsTo(Localite::class);
    } 
    
    public function Avis(){
        $this->hasMany(Avis::class);
    } 
}
