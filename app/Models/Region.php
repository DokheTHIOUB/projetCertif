<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'region_id',
        'nom_region',
        'code_postal',
    ]; 

    public function hopitaux(){
        $this->belongsTo(hopitaux::class);
    } 
}
