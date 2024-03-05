<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\rdv;
use App\Models\Docteur;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Requests\RdvRequest;
use App\Models\DocteurHopital;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RdvControlleur extends Controller
{

    public function listeRdv() 
    {
        $user=Auth::user()->docteur;
        //dd($user);
        $rdv = rdv::where('docteur_id', $user->id)->get();
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les rendez-vous',
                'liste rdv' => $rdv ,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function listeRdvEnAttente(){
        $user=Auth::user()->docteur;
        $rdv = rdv::where('docteur_id', $user->id)->where('statut','en_attente')->get();
        try {     
            return response()->json([
                'status_code' => 200, 
                'status_message' => 'Voici la liste des rendez-vous en attente',
                'rendez-Vous' =>  $rdv
            ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    public function listeRdvAnnuler(){ 
        $user=Auth::user()->docteur;
        $rdv = rdv::where('docteur_id', $user->id)->where('statut','annuler')->get();
        try {   
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste des rendez-vous annulés',
                'rendez-Vous' => $rdv
            ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    public function listeRdvConfirmer(){
        try {  
            $user=Auth::user()->docteur;
            $rdv = rdv::where('docteur_id', $user->id)->where('statut','confirmer')->get();  
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste des rendez-vous confirmés',
                'rendez-Vous' => $rdv,
            ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    public function store(RdvRequest $request)
    {
      $user=Auth::user()->client;
        try { 
             {
                $rdv = new rdv();
                $rdv->date = $request->date;
                $rdv->heure = $request->heure;
                $rdv->descriptiondubesoin = $request->descriptiondubesoin; 
                $rdv->client_id = $user->id;
                $rdv->docteur_id = $request->docteur_id; 
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
   
    public function Rechercheenfonctiondesdates(Request $request)
    {
       try 
       {
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

    public function Statut(rdv $rdv, DocteurHopital $docteurHopital)
    { 
        $utilisateur= Auth::user();
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
        
        elseif($rdv->statut==='confirmer'  && $docteurHopital->utilisateur_id==$utilisateur->id){
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
                $rdv->statut='annuler'  && $docteurHopital->utilisateur_id==$utilisateur->id;
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
    
    public function update(RdvRequest $request, rdv $rdv)
    {
        $user=Auth::user()->docteur;
        $rdv = rdv::where('docteur_id', $user->id)->first();
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

   
}