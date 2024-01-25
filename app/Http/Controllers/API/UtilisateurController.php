<?php

namespace App\Http\Controllers\API;


use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUtilisateurRequest;
use App\Http\Requests\UpdateUtilisateurRequest;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

        public function login(Request $req)  {
       
            $req->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            $credentials = $req->only('email','password');
            $token = Auth::attempt($credentials);
            // dd($token);
            if (!$token){
                return response()->json([
                    'status' => 'erreur',
                    'message' => ' La connexion a échoué '
                ]);
            }
    
        $user=Auth::user();
        if($user->role_id==1){
    
            return response()->json([
                  'user'=>$user,
                  'authorization'=>[
                    'token'=> $token,
                    'type'=> 'bearer',
                    'status' => 'success',
                    'message' => 'connexion réussie',
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
                    'message' => 'connexion réussie',
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
                'message' => 'connexion réussie',
                ]
          ]);
        }
        }

        public function logout(){
            Auth::logout();
            return response()->json([
                'message' => 'Déconnexion réussie'
            ]);
        }
    


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreUtilisateurRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUtilisateurRequest $request, Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        //
    }
}
