<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StoreClientRequest;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\DocteurController;
use App\Http\Controllers\API\UtilisateurController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UtilisateurController::class, 'login']);


//Route d'inscription et de connexion pour les Docteurs 
Route::middleware(['auth:api','admin'])->group(function (){
    Route::post('/registerdocteur', [DocteurController::class, 'registerDocteur']);
   
    
}); 

Route::post('/loginDocteur', [DocteurController::class, 'loginDocteur']);
// Route::middleware(['auth:api','docteur'])->group(function(){ 
    Route::post('/logoutDocteur', [DocteurController::class, 'logoutDocteur']);
  
   
// });


//ROute d'inscription, connexion et de deconnexion des Clients 

    Route::post('/logoutClient', [ClientController::class, 'logoutClient']);
    Route::post('/loginClient', [ClientController::class, 'loginClient']);
    Route::post('/registerclient', [ClientController::class, 'registerClient']); 
    



