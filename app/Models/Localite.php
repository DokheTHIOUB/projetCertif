<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
    protected $fillable = [
        'nom_localite',
        'code_postal',
    ];
}
