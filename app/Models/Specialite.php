<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    protected $fillable = [
        'specialite_id',
        'nom_specialite'
    ]; 

    public function DocteurHopital(){
        $this->hasMany(DocteurHopital::class);
    } 

   
}
