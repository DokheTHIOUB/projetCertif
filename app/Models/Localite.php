<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
    protected $guarded = [
    
    ];
    public function hopitaux(){
        $this->belongsTo(hopitaux::class);
    } 


}
