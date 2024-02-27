<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Localite;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreLocaliteRequest;
use App\Http\Requests\UpdateLocaliteRequest;
use App\Models\Region;
use Locale;

class LocaliteController extends Controller
{

    public function index(localite $localite)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les localites',
                'localite' => localite::all(),
                
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(StoreLocaliteRequest $request)
    {
        $localite = new Localite();

        $localite->nom_localite = $request->nom_localite;
        $localite->code_postal = $request-> code_postal;
        $localite->region_id = $request-> region_id;
        $localite->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'localite enregistrer',
            'liste_specialite' => $localite, 
        ]);
    }
    
    public function update(StoreLocaliteRequest $request, localite $localite)
    {
        try {
            $localite->nom_localite = $request->nom_localite;
            $localite->code_postal = $request-> code_postal;
            $localite->region_id = $request-> region_id;
            $localite->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La localite a été modifié',
                'localite' => $localite
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(Localite $localite)
    {
        try {
            $localite->delete();
           
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La localite a été supprimé',
                'localite' => $localite
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
   
}
