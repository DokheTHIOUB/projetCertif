<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AvisController extends Controller
{


    public function store(Request $request)
    {
        try {
            $avis = new Avis();
            $avis->description = $request->description;
            $avis->client_id = $request->client_id;
            $avis->hopital_id = $request->hopital_id;
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

    // public function storeImage($image)
    // {
    //     return $image->store('imagesArticles', 'public');
    // }

    public function update(Request $request, Avis $avis)
    {
        try {
            $avis->description = $request->description;
            $avis->client_id = $request->client_id;
            $avis->hopital_id = $request->hopital_id;
            $avis->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'avis a été modifie',
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
