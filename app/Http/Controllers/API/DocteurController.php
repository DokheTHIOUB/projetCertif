<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Docteur; 
use App\Models\Utilisateur;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\RegisterDocteur;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreDocteurRequest;
use App\Http\Requests\UpdateDocteurRequest;
use App\Http\Requests\StoreUtilisateurRequest;

class DocteurController extends Controller
{
   
    public function registerDocteur( RegisterDocteur $request)
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
                ]
        );
        return response()->json([
            'message' => 'Bonjour docteur',
            'user' => $docteur
        ]);
              }
            

            public function index(Docteur $docteur)
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


    public function archive(Docteur $docteur)
    {
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
    }


       //Cette methode permet de récuperer un docteur spécifique
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


    public function Docteurdisponible(Docteur $docteur)
    {
        try {
            if ($docteur->statut == 'disponible') {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des docteurs disponible',
                    'docteur disponible' => Docteur::where('disponible', 1)->get(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    //Liste des docteurs indisponible
    public function DocteurIndisponible(Docteur $docteur)
    {
        try {
            if ( $docteur->statut == 'indisponible' ) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des Docteurs indisponible',
                    'docteur' => Docteur::where('statut', 0)->get(),
                ]);
            }
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Docteur $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docteur $docteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   


    public function update(Request $request, Docteur $docteur)
    {
        try {
            [  'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe, 
            'age' => $request->age, 
            'telephone' => $request->telephone, 
            'email' => $request->email, 
            'adresse' => $request->adresse, 
            'photo_profil' => $request->photo_profil, 
            'password' => Hash::make($request->password),
            'role_id'=>$request->role_id, ];
            $utilisateur->save();
            [ 
            'diplome' => $request->diplome,
            'numero_licence' =>  $request->numero_licence,
            'annee_experience' => $request->annee_experience , 
            'specialite_id'=>$request->specialite_id ,
            'utilisateurs_id'=>$user->id, ]
           
            $docteur->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'événement a été modifier',
                'docteur' => $docteur
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }


    public function destroy(Docteur $docteur)
    {
        try {
            $docteur->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'événement a été supprimer',
                'docteur' => $docteur
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
   
}
