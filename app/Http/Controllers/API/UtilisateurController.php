<?php

namespace App\Http\Controllers\API;
use Exception;
use App\Models\Utilisateur;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUtilisateurRequest;
use App\Http\Requests\UpdateUtilisateurRequest;

class UtilisateurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','listeUtilisateurs']]);
    }

    public function login(StoreUtilisateurRequest $req) 
    {
            $credentials = $req->only('email','password');
            $token = Auth::attempt($credentials);
            if (!$token){
                return response()->json([
                    'status' => 'erreur',
                    'message' => ' Email ou mot de passe incorrecte '
                ]);
            }
             $user=Auth::user();
        if($user->role_id==1)
        {
             return response()->json([
                'user'=>$user,
                'authorization'=> [
                'token'=> $token,
                'type'=> 'bearer',
                'status' => 'success',
                'message' => 'Bonjour Admin ',
                 ]
                ]);
        }

        elseif($user->role_id==2){
    
            return response()->json([
                  'user'=>$user,
                  'authorization'=>[
                    'token'=> $token,
                    'type'=> 'bearer',
                    'status' => 'success',
                    'message' => 'Bonjour Client ',
                  ]
            ]);
        }

        else{ 
            return response()->json([
                'user'=>$user,
                'authorization'=>[
                  'token'=> $token,
                  'type'=> 'bearer',
                  'status' => 'success',
                'message' => 'Bonjour Docteur',
                ]
            ]);
         }
    }

    public function logout(){
        // dd('ok');
        Auth::logout();
        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function listeUtilisateurs()
    {
        try {
        
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tout les clients',
                'liste client' => Utilisateur::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
     }
}
