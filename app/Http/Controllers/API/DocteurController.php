<?php
namespace App\Http\Controllers\API;

use Exception;
use App\Models\Docteur; 
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterDocteur;

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
                ] );
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

    public function disponibilite(Docteur $docteur)
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
                $docteur->update([
                    'statut' => 'indisponible',
                ]);
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
    
    public function update(Request $request, Docteur $docteur)
    {
        try {
           
            $utilisateur = $docteur->utilisateur;
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
            
            $docteur->diplome = $request->diplome;
            $docteur->numero_licence = $request->numero_licence;
            $docteur->annee_experience = $request->annee_experience;
            $docteur->specialite_id = $request->specialite_id;
            $docteur->update();
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le docteur a été modifié',
                'docteur' => $docteur
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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

    public function filterDocteurparspecialite(Request $request)
{
    try {
        $specialite_id = $request->input('specialite_id'); // Récupérer les docteurs en fonction de leur specialites
        $docteur = Docteur::where('specialite_id', $specialite_id)->get();  // Retourner une réponse JSON avec les hôpitaux filtrés
        return response()->json([
            'status_code' => 200,
            'status_message' => 'docteurs filtrés par specialité avec succès',
            'filtrer_hospitals' => $docteur,
        ]);
    } catch (Exception $e) {
    
        return response()->json([$e]);
    }
} 
   
}
