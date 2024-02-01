<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreAvisRequest;
use App\Http\Requests\UpdateAvisRequest;

class AvisController extends Controller
{


    public function store(StoreAvisRequest $request)
    {
        try {
            $avis = new Avis();
            $avis->description = $request->description;
            $avis->client_id = $request->client_id;
            $avis->hopitaux_id = $request->hopitaux_id;
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
              

    public function update(UpdateAvisRequest $request, avis $avis)
    {
        try {
            $avis->description = $request->description;
            $avis->client_id = $request->client_id;
            $avis->hopitaux_id = $request->hopitaux_id;
            $avis->update();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'avis a été modifié',
                'avis' => $avis
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(Avis $avis)
    {
        try {
            $avis->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'avis a été supprime',
                'avis' => $avis
            ]);
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
