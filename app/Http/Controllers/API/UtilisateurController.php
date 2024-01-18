<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Docteur;
use App\Models\Utilisateur;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUtilisateurRequest;

class UtilisateurController extends Controller
{


    public function registerDocteur( StoreUtilisateurRequest $request)
    {
        try{
            $user = new Docteur();
            $user->nom = $request->nom; 
            $user->prenom = $request->prenom; 
            $user->telephone = $request->telephone;
            $user->nombre_annee_experience = $request->nombre_annee_experience;
            $user->email = $request->email;
            $user->articles_id = $request->articles_id;
            $user->password = Hash::make($request->password);

            if ($request->hasFile('photo_profil')) {
                $file = $request->file('photo_profil');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('profil', $filename, 'public');
                $user->photo_profil = $path;
            }
            
            $user->save();
            return response()->json([
                'status_code'=>200,
                'status_message'=>'utilisateur ajouté avec succes',
                'status_body'=>$user
            ]);
    
            }
            catch(Exception $e){
                return response()->json([$e]);
            }
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
