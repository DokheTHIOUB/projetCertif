<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegionController extends Controller
{
    public function index(Region $Region)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les Regions',
                'Region' => Region::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }


    public function store(Request $request)
    {
        $Region = new Region();
        $Region->nom_region = $request->nom_region;
        $Region->save();


        return response()->json([
            'status_code' => 200,
            'status_message' => 'Region enregistrer',
            'liste_Region' => $Region
        ]);

    }


      //Modifier des Regions
      public function update(Request $request, Region $Region)
      {
          try {
              $Region->nom_Region = $request->nom_Region;
              $Region->save();
              return response()->json([
                  'status_code' => 200,
                  'status_message' => 'La Region a été modifié',
                  'Region' => $Region
              ]);
          } catch (Exception $e) {
              return response()->json($e);
          }
      }
  
       //SUPPRIMER des Regions
  
      public function destroy(Region $Region)
      {
          try {
              $Region->delete();
             
              return response()->json([
                  'status_code' => 200,
                  'status_message' => 'La Region a été supprimé',
                  'Region' => $Region
              ]);
          } catch (Exception $e) {
              return response()->json($e);
          }
      }


}