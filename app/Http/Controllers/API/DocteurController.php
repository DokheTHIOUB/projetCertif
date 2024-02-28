<?php
namespace App\Http\Controllers\API;

use Exception;
use App\Models\Docteur; 
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateDocteurRequest;
use App\Http\Requests\RegisterDocteurRequest;
use App\Http\Requests\FiltreDocteurSpecialiteRequest;

class DocteurController extends Controller
{   

    public function filterDocteurparSpecialite(FiltreDocteurSpecialiteRequest $request, Docteur $docteur)
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
    

    public function index()
    {
        $docteurs=Docteur::all();
        // dd($docteur);
        $data=[];
        foreach($docteurs as $docteur){ 
        $utilisateur= Utilisateur::where('id',$docteur->utilisateurs_id)->first();
        $data[]=[
            'id'=>$docteur->id,
            'nom'=>$utilisateur->nom,
            'prenom'=>$utilisateur->Prenom, 
            'annee_experience'=>$docteur->annee_experience,
            'statut'=>$docteur->statut,
            'specialite'=>$docteur->specialite->nom_specialite
        ];
        }
        
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les docteurs',
                'liste docteur' =>$data,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
   
    private function storeImage($image)
    {
        return $image->store('photoProfilDocteur', 'public');
    }


    public function registerDocteur(RegisterDocteurRequest$request)
    {
        // dd($request->validated());
        // $user = Utilisateur::create([
        //     'nom' => $request->nom,
        //     'prenom' => $request->prenom,
        //     'sexe' => $request->sexe,
        //     'age' => $request->age,
        //     'telephone' => $request->telephone,
        //     'email' => $request->email,
        //     'adresse' => $request->adresse,
        //     'password' => Hash::make($request->password),
        //     'role_id' => $request->role_id,
        // ]);
    
        $user = new Utilisateur();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->sexe = $request->sexe;
        $user->age = $request->age;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->adresse = $request->adresse;
        $user->password = Hash::make($request->password);
        $user->role_id = 3;
        if ($request->hasFile('photo_profil')) {
            $imageFile = $request->file('photo_profil');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('/photoProfilDocteur'), $imageName);
            $user->photo_profil = $imageName; 
        }
        $user->save();
        $docteur = Docteur::create([
            'annee_experience' => $request->annee_experience,
            'specialite_id' => $request->specialite_id,
            'utilisateurs_id' => $user->id,
        ]);
        return response()->json([
            'message' => 'Bonjour docteur',
            'user' => $docteur,
        ]);
    }
    
    public function update(UpdateDocteurRequest $request, Utilisateur $utilisateur, Docteur $docteur)
    {
        if($docteur->utilisateur_id==$utilisateur->id) {

            try {
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
      
    }


    public function Statut( Docteur $docteur)
    {  
        $utilisateur= Auth::user();
        if ($docteur->statut==='indisponible' && $docteur->utilisateur_id==$utilisateur->id) {
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
        }elseif($docteur->statut==='disponible' && $docteur->utilisateur_id==$utilisateur->id){
            try {
                $docteur->update([
                    'statut' => 'disponible',
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

    }
