<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Role;
use App\Models\Client;
use App\Models\Utilisateur;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    public function registerClient( StoreClientRequest $request)
    {
        
    $roleclient = Role::where('nom_role','client')->first();
    // $user =Utilisateur::create($request->validated());
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
            'role_id' => $request->role_id, 
        ]); 
        $client = $user->client()->create();
        return response()->json([
            'message' => ' Bonjour client ',
            'user' => $client
        ]);
     } 

     
     public function index(Client $docteur)
     {
         try {
             return response()->json([
                 'status_code' => 200,
                 'status_message' => 'Voici la liste de tout les clients',
                 'liste docteur' => Client::all(),
             ]);
         } catch (Exception $e) {
             return response()->json($e);
         }
     } 

     public function Totalclient()
     {
 
         try {
 
              $totalClient= Client::count();
             return response()->json([
             'status_code' => 200,
             'status_message' => 'Le nombre total de Client',
             'data' => [
             'Total_Client' => $totalClient,
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
    public function store(StoreClientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
