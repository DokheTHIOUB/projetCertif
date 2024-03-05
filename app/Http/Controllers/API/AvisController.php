<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAvisRequest;
use App\Http\Requests\UpdateAvisRequest;
use App\Models\hopital;
use PhpParser\Node\Stmt\Else_;

class AvisController extends Controller
{

    public function index()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tous les avis',
                'Avis' => Avis::all(),
            ]); 
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(StoreAvisRequest $request, hopital $hopital)
    {
        $user=Auth::user()->client;
        try {
            
            $avis = new Avis();
            $avis->description = $request->description;
            $avis->client_id = $user->id;
            $avis->Hopitals_id = $hopital->id;
            $avis->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'avis a été ajouté',
                'avis' => $avis
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
              
    public function update(UpdateAvisRequest $request, hopital $hopital )
    {
        
        $user=Auth::user()->client;
        $avis = Avis::where('hopitals_id', $hopital->id)->where('client_id', $user->id)->first();
        try {
            if($avis->client_id==$user->id){
             $avis->description = $request->description;
             $avis->update();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'L\'avis a été modifié',
                    'avis' => $avis
                ]);
             }
            else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous ne pouvez pas supprimer cet avis',
                ], 403);
        }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy( hopital $hopital)
    {
        $user=Auth::user()->client;
        $avis = Avis::where('hopitals_id', $hopital->id)->where('client_id', $user->id)->first();
        try {
            if($avis->client_id==$user->id){
                $avis->delete();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'L\'avis a été supprimé',
                    'avis' => $avis
                ]); 
              }
              else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous ne pouvez pas supprimer cet avis',
                ], 403);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    } 
}

