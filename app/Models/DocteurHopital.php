<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocteurHopital extends Model
{
    protected $guarded = [
    
    ];

    public function docteur(){
        $this->belongsTo(Docteur::class);
    } 

    public function hopitaux(){
        $this->belongsTo(hopitaux::class);
    } 

    
}
