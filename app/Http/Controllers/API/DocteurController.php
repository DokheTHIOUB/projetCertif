<?php

namespace App\Http\Controllers\API;

use App\Models\Docteur;
use App\Models\Utilisateur;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterDocteur;
use App\Http\Requests\StoreDocteurRequest;
use App\Http\Requests\UpdateDocteurRequest;

class DocteurController extends Controller
{
    public function registerDocteur( RegisterDocteur $request)
    {
    //    dd('ok');
         $user =Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe, 
            'age' => $request->age, 
            'telephone' => $request->telephone, 
            'role' => 'client',
            'email' => $request->email, 
            'adresse' => $request->adresse, 
            'photo_profil' => $request->photo_profil, 
            'password' => Hash::make($request->password),
           
        ]); 

            $docteur = $user->docteur()->create( 
                [ 
                    'diplome' => $request->diplome,
                    'specialite' => $request->specialite,
                    'numero_licence' =>  $request->numero_licence,
                    'annee_experience' => $request->annee_experience ,
                    'hopitaux_frequente' => $request->hopitaux_frequente,
                    'statut' =>$request->statut,
                ]
        );
        return response()->json([
            'message' => 'Bonjour docteur',
            'user' => $docteur
        ]);
            
            }


            
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
    public function store(Docteur $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Docteur $docteur)
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
     * Update the specified resource in storage.
     */
    public function update(UpdateDocteurRequest $request, Docteur $docteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docteur $docteur)
    {
        //
    }
}
