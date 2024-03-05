<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\hopital;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreHopitalRequest;
use App\Http\Requests\UpdatehopitalRequest;
use App\Http\Requests\FiltreHopitauxRequest;
use App\Models\Localite;

class HopitalController extends Controller
{
   
    public function index()
    {
        try {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des hopitaux ',
                    'hopitaux' => hopital::all(),
                ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function filterhopital(Request $request, Localite $localite)
    {
        try {
            $filtrehopital = $request->input('id', $localite);
            $hopital = hopital::where('localite_id', $filtrehopital)->get();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'hopital filtrés par localité avec succès',
                'hopital_filtres' => $hopital,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function TotalHopitaux()
    {
        try {
        $totalhopitaux= hopital::count();
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

    private function storeImage($image)
    {
        return $image->store('hopitauxImage', 'public');
    }

    public function ajouterHopital(StoreHopitalRequest $request)
    {
        try {
            $hopitaux = new hopital();
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $imageName = time() . '_' . $imageFile->getClientOriginalName();
                $imageFile->move(public_path('/hopitauxImage'), $imageName);
                $hopitaux->image=$imageName;
            $hopitaux->nom_hopital = $request->nom_hopital;
            $hopitaux->description = $request->description;
            $hopitaux->horaire = $request->horaire; 
            $hopitaux->localite_id = $request->localite_id; 
            $hopitaux->save();
            return response()->json([
                'status_code' => 200, 
                'status_message' => 'L\'hopital a été ajoute',
                'hopitaux' => $hopitaux
            ]);
        }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function update(UpdatehopitalRequest $request, hopital $hopitaux)
    {
        try {
        
            $hopitaux->nom_hopital = $request->nom_hopital;
            $hopitaux->description = $request->description;
            $hopitaux->horaire = $request->horaire; 
            $hopitaux->localite_id = $request->localite_id; 

            if ($request->hasFile("image")) {
                $hopitaux->image = $this->storeImage($request->image);
            }
            $hopitaux->update();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'hopital a été modifie',
                'hopitaux' => $hopitaux
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(hopital $hopitaux)
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

}
