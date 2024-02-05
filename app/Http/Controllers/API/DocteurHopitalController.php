<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Models\DocteurHopital;
use Illuminate\Routing\Controller;
use App\Http\Requests\DocteurHopitauxRequest;

class DocteurHopitalController extends Controller
{
   
    public function listeRdv(){

        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les Docteurs qui appartiennent à un hopital',
                'liste DocteurHopital' => DocteurHopital::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    
    }
    

    public function store(DocteurHopital $DocteurHopital , DocteurHopitauxRequest $request){
        
        try {
            $DocteurHopital = new DocteurHopital();
            $DocteurHopital->hopitauxs_id = $request->hopitauxs_id; 
            $DocteurHopital->docteurs_id = $request->docteurs_id; 
            $DocteurHopital->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Le Docteur a été ajouté et l\hopital ou il appartient',
                    'Docteur Hopital' => $DocteurHopital
                ]);
        
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

   
    public function update(DocteurHopital $DocteurHopital , DocteurHopitauxRequest $request)
    {

        try {
            $DocteurHopital->hopitauxs_id = $request->hopitauxs_id; 
            $DocteurHopital->docteurs_id = $request->docteurs_id; 
            $DocteurHopital->update();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Le Docteur a été modifié et l\hopital ou il appartient',
                    'rdv' => $DocteurHopital
                ]);
            } catch (Exception $e) {
            return response()->json($e);
        }

    }

}
