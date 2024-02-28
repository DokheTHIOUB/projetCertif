<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Models\DocteurHopital;
use Illuminate\Routing\Controller;
use App\Http\Requests\DocteurHopitauxRequest;
use Illuminate\Support\Facades\DB;

class DocteurHopitalController extends Controller
{
   
    public function listeDocteurHopital()
    {

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
    
    public function store(DocteurHopital $DocteurHopital , DocteurHopitauxRequest $request)
    {    
        try {
            $DocteurHopital = new DocteurHopital();
            $DocteurHopital->hopitals_id  = $request->hopitals_id   ; 
            $DocteurHopital->docteur_id = $request->docteur_id; 
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
            $DocteurHopital->hopitals_id = $request->hopitals_id; 
            $DocteurHopital->docteur_id = $request->docteur_id; 
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

    public function destroy(DocteurHopital $DocteurHopital)
    {
        try{
            $DocteurHopital->delete();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Le docteur a été supprime',
                    'Docteur_hopital' => $DocteurHopital
                ]);
            }  catch(Exception $e) {
            return response()->json($e);
            }
    }

}
  