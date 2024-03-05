<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rdv extends Model
{
    use HasFactory;
    protected $guarded = [
    
    ]; 

    public function docteur(){
        $this->belongsTo(Docteur::class);
    } 

    public function client(){
        $this->belongsTo(Client::class);
    } 
}
