<?php
namespace App\Http\Controllers\API;

use Exception;
use App\Models\Docteur; 
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DisponibiliteRequest;
use App\Http\Requests\UpdateDocteurRequest;
use App\Http\Requests\RegisterDocteurRequest;


class DocteurController extends Controller
{
   
    public function registerDocteur( RegisterDocteurRequest $request)
    {
        // dd($request->validated());
         $user =Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe, 
            'age' => $request->age, 
            'telephone' => $request->telephone, 
            'email' => $request->email, 
            'adresse' => $request->adresse, 
            'photo_profil' => $request->photo_profil, 
            'password' => Hash::make($request->password),
            'role_id'=>$request->role_id
        ]); 
        // dd($user->id);
            $docteur =Docteur::create( 
                [ 
                    'diplome' => $request->diplome,
                    'numero_licence' =>  $request->numero_licence,
                    'annee_experience' => $request->annee_experience , 
                    'specialite_id'=>$request->specialite_id ,
                    'utilisateurs_id'=>$user->id,
                ] ); 
                return response()->json([
                    'message' => 'Bonjour docteur',
                    'user' => $docteur          
        ]);
    }
        

    public function update(UpdateDocteurRequest $request, Utilisateur $utilisateur, Docteur $docteur)
    {
        // dd($request->all());
        try {
// dd($utilisateur);
            $utilisateur->nom = $request->nom;
            $utilisateur->prenom = $request->prenom;
            $utilisateur->sexe = $request->sexe;
            $utilisateur->age = $request->age;
            $utilisateur->telephone = $request->telephone;
            $utilisateur->email = $request->email;
            $utilisateur->adresse = $request->adresse;
            $utilisateur->photo_profil = $request->photo_profil;
            $utilisateur->password = Hash::make($request->password);
            $utilisateur->update();
            
            $docteur = Docteur::where('utilisateurs_id', $utilisateur->id)->first();
            $docteur->annee_experience = $request->annee_experience;
            $docteur->update();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le docteur a été modifié',
                'docteur' =>  $utilisateur,
                'Info supplementaire'=>$docteur
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
            public function index()
            {
                try {
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Voici la liste de tout les docteurs',
                        'liste docteur' => Docteur::all(),
                    ]);
                } catch (Exception $e) {
                    return response()->json($e);
                }
            }

    public function Statut( Docteur $docteur)
    {   
        if ($docteur->statut==='indisponible') {
            try {
                $docteur->update([
                    'statut' => 'disponible',
                ]);
                $docteur->save();
                  return response()->json([
                    'status_code' => 200,
                    'status_message' => "docteur disponible",
                ]);
            } catch (Exception $e) {
                return response()->json($e);
            } 
        }else{
            try {
               
                $docteur->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => "docteur indisponible",
                ]);
            } catch (Exception $e) {
                return response()->json($e);
            }
        } 
       
    }

              public function show(Docteur $docteur)
              {
                  try {
                      return response()->json([
                          "statu_code"=> 200,
                          "status_message"=>"Voici le docteur spécifique",
                          "docteurid"=> Docteur::find($docteur),
                      ]);
                  } catch (Exception $e) {
                      return response()->json($e);
                  }
              }


    public function Docteurdisponible()
    {
        try {
            {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des docteurs disponible',
                    'docteur' => Docteur::where( 'statut',  '=', 'disponible')->get(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    //Liste des docteurs indisponible
    public function DocteurIndisponible()
    {
        try {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des Docteurs indisponible',
                    'docteur' => Docteur::where( 'statut',  '=', 'indisponible')->get(),
                ]);
            
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function Totaldocteur()
    {
        try {

             $totalDocteur= Docteur::count();
            return response()->json([
            'status_code' => 200,
            'status_message' => 'Le nombre total de docteur',
            'data' => [
            'Total_docteur' => $totalDocteur,
            ]]);

            } 
        catch (Exception $e) {  
            return response()->json($e);
       }
    }
    
   
    public function destroy(Docteur $docteur)
    {
        try {
            $docteur->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le docteur a été supprimé',
                'docteur' => $docteur
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }


    public function filterDocteurparSpecialite(Request $request, Docteur $docteur)
{
    try {
        $filtreSpecialite = $request->input('specialite_id');
        // $docteur = Docteur::where('specialite_id', 'like', '%' . $filtreSpecialite . '%')->get();
        $docteur = Docteur::where('specialite_id', $filtreSpecialite)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'docteur filtrés par localité avec succès',
            'docteur_filtres' => $docteur,
        ]);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

   
}
