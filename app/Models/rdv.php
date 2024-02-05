<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rdv extends Model
{
    use HasFactory;
    protected $guarded = [
    
    ]; 

    public function docteurHopital(){
        $this->belongsTo(docteurHopital::class);
    } 

    public function client(){
        $this->belongsTo(Client::class);
    } 
}
