<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocteurHopitalClient extends Model
{
    protected $guarded = [
    
    ]; 

    public function docteurHopital(){
        $this->belongsTo(docteurHopital::class);
    } 

    public function hopitaux(){
        $this->belongsTo(Client::class);
    } 
}
