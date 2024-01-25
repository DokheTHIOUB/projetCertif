<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
    protected $fillable = [
        'localite_id',
        'nom_localite',
        'code_postal', 
        'region_id',

    ]; 

    public function hopitaux(){
        $this->belongsTo(hopitaux::class);
    } 


}
