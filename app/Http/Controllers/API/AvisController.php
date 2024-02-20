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
                'status_message' => 'L\'avis a été ajoute',
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
          else{
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voue n\'etes pas autorisé a modifié cette avis',
            ]);
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
                    'status_message' => 'L\'avis a été supprime',
                    'avis' => $avis
                ]); 
            }
            else{
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voue ne pouvez pas supprimer cette avis',
                ]);
              }
          
        } catch (Exception $e) {
            return response()->json($e);
        }
    } 

    public function index()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tous les avis',
                'Mentor' => Avis::all(),
            ]); 
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

}
