<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Role;
use App\Models\Client;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{

    private function storeImage($image)
    {
        return $image->store('/photoProfilClient', 'public');
    }

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
        if ($request->hasFile('photo_profil')) {
            $imageFile = $request->file('photo_profil');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('/photoProfilClient'), $imageName);
            $user->photo_profil = $imageName; 
        }
        $client = $user->client()->create();
        return response()->json([
            'message' => ' Bonjour client ',
            'user' => $client
        ]);
     } 

     public function update(StoreClientRequest $request, Client $Client)
     {
         try {
            $user=Utilisateur::where('id',$Client->utilisateur_id)->first();
            $user->nom=$request->nom;
            $user->prenom=$request->prenom;
            $user->sexe=$request->sexe;
            $user->age=$request->age;
            $user->telephone=$request->telephone;
            $user->email=$request->email;
            $user->adresse=$request->adresse;
            $user->photo_profil=$request->photo_profil;
            $user->password=$request->password;
            $user->update();
             return response()->json([
                 'status_code' => 200,
                 'status_message' => 'Le client a été modifié',
                 'Client' => $user
             ]);
         } catch (Exception $e) {
             return response()->json($e);
         }
     }

     public function index()
     {
         try {
          $client=Utilisateur::where('role_id',2)->get();
        //   dd($client);
             return response()->json([
                 'status_code' => 200,
                 'status_message' => 'Voici la liste de tout les clients',
                 'liste client' => $client
             ]);
         } catch (Exception $e) {
             return response()->json($e);
         }
     } 

     public function Totalclient()
     {
         try {
              $totalClient= Utilisateur::where('role_id',2)->count();
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

    public function destroy(Client $Client)
    {
        try {
            $Client->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le Client a été supprimé',
                'Client' => $Client
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

}
