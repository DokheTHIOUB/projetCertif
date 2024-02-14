<?php

namespace App\Models;

use App\Models\hopital;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocteurHopital extends Model
{
    use HasFactory;
    protected $guarded = [
    
    ];

    public function docteur(){
        $this->belongsTo(Docteur::class);
    } 

    public function hopitaux(){
        $this->belongsTo(hopital::class);
    } 

    
}
