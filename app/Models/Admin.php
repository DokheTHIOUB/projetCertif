<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    protected $fillable = [
        'utilisateur_id'
    ];

    public function utilisateur(){

            return $this->belongsTo(Utilisateur::class);} 

}

