<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DocteurHopitalController extends Controller
{
    $data=[
        'id' => $user['id'],
        'nom_hopital' => $user['nom_hopital'],
        'description' => $user['description'],
        'id_localite' => $user['id_localite'],
        'id_region' => $user['id_region'], 
        'horaire' => $user['horaire']
         ];
}
