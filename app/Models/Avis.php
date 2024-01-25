<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
   
    protected $fillable = [
        'avis_id',
        'description', 
        'client_id',
        'hopital_id',

    
    ]; 

    public function client(){
        $this->belongsTo(client::class);
    } 

    public function Hopital(){
        $this->belongsTo(hopitaux::class);
    } 
}
