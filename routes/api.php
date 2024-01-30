<?php

use FFI\CData;
use Illuminate\Http\Request;
use App\Http\Middleware\Docteur;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StoreClientRequest;
use App\Http\Controllers\API\AvisController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\DocteurController;
use App\Http\Controllers\API\HopitalController;
use App\Http\Controllers\API\LocaliteController;
use App\Http\Controllers\API\SpecialiteController;
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
//ROute d'inscription, connexion et de deconnexion des Clients 

Route::get('/specialite', [SpecialiteController::class, 'index']);
Route::post('/specialite/create', [SpecialiteController::class, 'store']);
Route::delete('specialite/{specialite}', [SpecialiteController::class, 'destroy']);
Route::post('specialite/edit/{specialite}', [SpecialiteController::class, 'update']);

Route::get('/Region', [RegionController::class, 'index']);
// Route::post('/Region/create', [RegionController::class, 'store']);
Route::post('/Region/create', 'App\Http\Controllers\API\RegionController@store');
Route::delete('Region/{Region}', [RegionController::class, 'destroy']);
Route::post('Region/edit/{Region}', [RegionController::class, 'update']);

Route::get('/localite', [LocaliteController::class, 'index']);
Route::post('/localite/create', [LocaliteController::class, 'store']);
Route::delete('localite/{localite}', [LocaliteController::class, 'destroy']);
Route::post('localite/edit/{localite}', [LocaliteController::class, 'update']);

Route::get('/avis', [AvisController::class, 'index']);
Route::post('/avis/create', [AvisController::class, 'store']);
Route::delete('avis/{avis}', [AvisController::class, 'destroy']);
Route::post('avis/edit/{avis}', [AvisController::class, 'update']); 

Route::post('/registerclient', [ClientController::class, 'registerClient']); 
Route::post('/logoutClient', [UtilisateurController::class, 'logout']); 
Route::middleware(['auth:api','Client'])->group(function (){   
});

//Route d'inscription et de connexion pour les Docteurs 
Route::middleware(['auth:api','admin'])->group(function (){
    Route::post('/registerdocteur', [DocteurController::class, 'registerDocteur']);
    Route::post('/logoutAdmin', [UtilisateurController::class, 'logout']);    
}); 

Route::middleware(['auth:api','docteur'])->group(function(){ 
    Route::post('/logoutDocteur', [UtilisateurController::class, 'logout']); 
});

Route::get('docteur', [DocteurController::class, 'index']); 
Route::put('docteur/disponibilite/{docteur}', [DocteurController::class, 'disponibilite']); 
Route::get('docteur/show/{docteur}', [DocteurController::class, 'show']); 
Route::get('docteur/indisponible', [DocteurController::class, 'DocteurIndisponible']); 
Route::put('docteur/disponible/', [DocteurController::class, 'Docteurdisponible']); 
Route::get('totaldocteur',[DocteurController::class,'Totaldocteur']);  
Route::get('Docteur/filtre/specialite',[DocteurController::class,'filterDocteurparspecialite']); 
Route::post('Docteur/edit/{docteur}', [DocteurController::class, 'update']); 
Route::put('docteur/archive/{docteur}', [DocteurController::class, 'archive']);

Route::get('Hopital', [HopitalController::class, 'index']); 
Route::post('Hopital/edit/{hopitaux}', [HopitalController::class, 'update']); 
Route::post('Hopital/create', [HopitalController::class, 'ajouterHopital']); 
Route::get('Hopital/totalHopitaux', [HopitalController::class, 'TotalHopitaux']); 
Route::get('Hopital/localite', [HopitalController::class, 'filterHopitauxparLocalite']); 
Route::post('Hopital/{hopitaux}', [HopitalController::class, 'destroy']); 

Route::get('client', [ClientController::class, 'index']); 
Route::get('client/Totalclient', [clientController::class, 'Totalclient']); 
Route::get('client/{client}', [clientController::class, 'destroy']); 
Route::get('client/edit/{client}', [clientController::class, 'update']); 

