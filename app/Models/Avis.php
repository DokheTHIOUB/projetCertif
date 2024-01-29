<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
   
    protected $guarded = [
    
    ];

    public function client(){
        $this->belongsTo(client::class);
    } 

    public function Hopital(){
        $this->belongsTo(hopitaux::class);
    } 
}
