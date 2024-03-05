<?php

namespace App\Models;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docteur extends Model
{
    use HasFactory;
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
