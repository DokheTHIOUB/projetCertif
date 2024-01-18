<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeDocteur extends Model
{
    protected $fillable = [
        'demande',
        'etat_demande',
        'client_id',
        'docteur_id',
    ];

}
