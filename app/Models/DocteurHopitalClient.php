<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocteurHopitalClient extends Model
{
    protected $fillable = [
        'docteurHopitalClient_id', 
        'docteurHopital_id', 
        'client_id', 

    ]; 

    public function docteurHopital(){
        $this->belongsTo(docteurHopital::class);
    } 

    public function hopitaux(){
        $this->belongsTo(Client::class);
    } 
}
