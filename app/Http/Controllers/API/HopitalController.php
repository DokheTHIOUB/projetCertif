<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\hopitaux;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HopitalController extends Controller
{
   

public function filterHopitauxparLocalite(Request $request)
{
    try {
        $localiteId = $request->input('localite_id');
        // Récupérer les hôpitaux en fonction de la localité choisie
        $hopitaux = hopitaux::where('localite_id', $localiteId)->get();
        // Retourner une réponse JSON avec les hôpitaux filtrés
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Hôpitaux filtrés par localité avec succès',
            'filtrer_hospitals' => $hopitaux,
        ]);
    } catch (Exception $e) {
    
        return response()->json([$e]);
    }
} 


public function TotalHopitaux()
{

    try {

       $totalhopitaux= hopitaux::count();

        return response()->json([
        'status_code' => 200,
        'status_message' => 'Le nombre total d\'hopitaux ',
        'data' => [
        'totalhopitaux' => $totalhopitaux,
        ]]);

        } 
    catch (Exception $e) {
 
        return response()->json($e);
   }
}


public function store(Request $request)
{
    try {
        $hopitaux = new hopitaux();
        $hopitaux->nom_hopital = $request->nom_hopital;
        $hopitaux->description = $request->description;
        $hopitaux->longitude = $request->longitude;
        $hopitaux->lattitude = $request->lattitude;
        $hopitaux->horaire = $request->horaire; 
        $hopitaux->localite_id = $request->localite_id; 
        $hopitaux->image = $this->storeImage($request->image);
        $hopitaux->save();
        return response()->json([
            'status_code' => 200, //Pour montrer que la réquete a été effectuer
            'status_message' => 'L\'hopital a été ajoute',
            'hopitaux' => $hopitaux
        ]);
    } catch (Exception $e) {
        return response()->json($e);
    }
}

private function storeImage($image)
{
    return $image->store('hopitauxImage', 'public');
}

public function update(Request $request, hopitaux $hopitaux)
{
    try {
        $hopitaux = new hopitaux();
        $hopitaux->nom_hopital = $request->nom_hopital;
        $hopitaux->description = $request->description;
        $hopitaux->longitude = $request->longitude;
        $hopitaux->lattitude = $request->lattitude;
        $hopitaux->horaire = $request->horaire; 
        $hopitaux->localite_id = $request->localite_id; 

        if ($request->hasFile("image")) {
            $hopitaux->image = $this->storeImage($request->image);
        }
        $hopitaux->save();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'L\'hopital a été modifie',
            'hopitaux' => $hopitaux
        ]);
    } catch (Exception $e) {
        return response()->json($e);
    }
}

public function destroy(hopitaux $hopitaux)
{
    try {
        $hopitaux->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'L\'hopital a été supprime',
            'hopitaux' => $hopitaux
        ]);
    } catch (Exception $e) {
        return response()->json($e);
    }
}


public function index(hopitaux $hopitaux)
{
    try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste des hopitaux ',
                'hopitaux' => hopitaux::all(),
            ]);
    } catch (Exception $e) {
        return response()->json($e);
    }
}

}
