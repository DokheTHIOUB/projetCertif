<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\rdv;
use App\Models\Docteur;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Requests\RdvRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RdvControlleur extends Controller
{

    public function listeRdv(rdv $rdv){

        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les rendez-vous',
                'liste rdv' => rdv::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    
    }
    

    public function store(RdvRequest $request ,  Docteur $Docteur){
        
        
    $user=Auth::user()->client;
        try { 
             {
                $rdv = new rdv();
                $rdv->date = $request->date;
                $rdv->heure = $request->heure;
                $rdv->descriptiondubesoin = $request->descriptiondubesoin; 
                $rdv->client_id = $user->id;
                $rdv->docteur_hopitals_id = $request->docteur_hopitals_id; 
                $rdv->save();
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Le rdv a été ajoute',
                        'rdv' => $rdv
                    ]);
            }
          
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

   
    public function update(RdvRequest $request, rdv $rdv)
    {

        try {
            $rdv->date = $request->date;
            $rdv->heure = $request->heure;  
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

    public function Statut(rdv $rdv)
    {   
        if ($rdv->statut==='en_attente') {
            try {
               // $rdv->update([ 'statut' => 'confirmer',]);
               $rdv->statut='confirmer';
                $rdv->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => "rdv confirmer",
                ]);
               } 
            catch (Exception $e) {
                return response()->json($e);
               } 
        }
        
        elseif($rdv->statut==='confirmer'){
            try { 
                // $rdv->update([
                //     'statut' => 'annuler',
                // ]);
                $rdv->statut='annuler';
                $rdv->save();
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => "rdv annuler",
                    ]);
                } 
            catch (Exception $e) {
                return response()->json($e);
            }
        } 

        else {
            try { 
                // $rdv->update([
                //     'statut' => 'Annuler',
                // ]);
                $rdv->statut='en_attente';
                $rdv->save();
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => "en attente",
                    ]);
                } 
            catch (Exception $e) {
                return response()->json($e);
            }
        } 
    }

    public function listeRdvEnAttente(){

        try {
            
            return response()->json([
                'status_code' => 200, 
                'status_message' => 'Voici la liste des rendez-vous en attente',
                'rendez-Vous' => rdv::where('statut','en_attente')->get(),
            ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }

    }
    
    public function listeRdvAnnuler(){

        try {
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste des rendez-vous annulés',
                'rendez-Vous' => rdv::where('statut','annuler')->get(),
            ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    public function listeRdvConfirmer(){

        try {
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste des rendez-vous confirmés',
                'rendez-Vous' => rdv::where('statut','confirmer')->get(),
            ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    public function Rechercheenfonctiondesdates(Request $request){
 
    try {

        $filtrerRdv = $request->input('date_id');
        $rdv = rdv::where('date_id', 'like', '%' . $filtrerRdv . '%')->get();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Rendez-Vous filtrés par jour avec succès',
                'Rendez-Vous_filtrés' => $rdv,
            ]);
        } 
        catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
}