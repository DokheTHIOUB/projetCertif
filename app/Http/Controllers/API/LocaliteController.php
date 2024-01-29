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
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    public function update(Request $request, localite $localite)
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

   
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Localite $localite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
   
}
