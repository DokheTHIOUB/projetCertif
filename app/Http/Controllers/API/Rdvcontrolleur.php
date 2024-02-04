<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RdvRequest;
use Exception;
use App\Models\rdv;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Rdvcontrolleur extends Controller
{

    public function store(RdvRequest $request){

        try {
            $rdv = new rdv();
            $rdv->date = $request->date;
            $rdv->heure = $request->heure;
            $rdv->horaire = $request->horaire; 
            $rdv->statut = $request->statut; 
            $rdv->descriptiondubesoin = $request->descriptiondubesoin; 
            $rdv->client_id = $request->client_id; 
            $rdv->docteur_hopitals_id = $request->docteur_hopitals_id; 
            $rdv->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'hopital a été ajoute',
                'rdv' => $rdv
            ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }

    }

   
    public function update(RdvRequest $request, rdv $rdv)
    {

        try {
            $rdv->date = $request->date;
            $rdv->heure = $request->heure;
            $rdv->horaire = $request->horaire; 
            $rdv->statut = $request->statut; 
            $rdv->descriptiondubesoin = $request->descriptiondubesoin;
            $rdv->update();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le rdv a été modifié',
                'rdv' => $rdv
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }

    }


    public function destroy(rdv $rdv)
    {
        try {
            $rdv->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le rdv a été supprimé',
                'rdv' => $rdv
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }



public function listeRdvEnAttente(){

}

public function listeRdvAnnuler(){

}

public function listeRdvConfirmer(){

}

public function Rechercheenfonctiondesdates(){

}

    public function disponibilite(rdv $rdv)
    {   
        if ($rdv->statut==='en_attente') {
            try {
                $rdv->update([
                    'statut' => 'confirmer',
                ]);
                $rdv->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => "rdv confirmer",
                ]);
            } catch (Exception $e) {
                return response()->json($e);
            } 
        }
        
        elseif($rdv->statut==='confirmer'){
            try { 
                $rdv->update([
                    'statut' => 'annuler',
                ]);
                $rdv->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => "rdv annuler",
                ]);
            } catch (Exception $e) {
                return response()->json($e);
            }
        } 

        else{
            try { 
                $rdv->update([
                    'statut' => 'Annuler',
                ]);
                $rdv->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => "en attente",
                ]);
            } catch (Exception $e) {
                return response()->json($e);
            }
        } 

    }

public function listeRdv(rdv $rdv){

    try {
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Voici la liste de tout les rendez-vous',
            'liste docteur' => rdv::all(),
        ]);
    } catch (Exception $e) {
        return response()->json($e);
    }

}


   

}
