<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreSpecialiteRequest;
use App\Http\Requests\UpdateSpecialiteRequest;


class SpecialiteController extends Controller
{

    public function index(Specialite $specialite)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les Specialites',
                'specialite' => Specialite::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(StoreSpecialiteRequest $request)
    {
        $specialite = new Specialite();
        $specialite->nom_specialite = $request->nom_specialite;
        $specialite->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'specialite enregistrer',
                'liste_specialite' => $specialite
            ]);
    }
    
    public function update(UpdateSpecialiteRequest $request, specialite $specialite)
    {
        try {
            $specialite->nom_specialite = $request->nom_specialite;
            $specialite->update();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La specialite a été modifié',
                'specialite' => $specialite
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
  
    public function destroy(Specialite $specialite)
    {
        try {
            $specialite->delete();
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La specialite a été supprimé',
                'specialite' => $specialite
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    } 

}
 