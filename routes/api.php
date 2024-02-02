<?php

use FFI\CData;
use Illuminate\Support\Facades\Route;
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
    Route::get('/avis', [AvisController::class, 'index']); 
    Route::get('docteur', [DocteurController::class, 'index']); 
    Route::get('Hopital', [HopitalController::class, 'index']); 
    Route::get('/Region', [RegionController::class, 'index']); 
    Route::post('/login', [UtilisateurController::class, 'login']);
    Route::get('/localite', [LocaliteController::class, 'index']);
    Route::get('/specialite', [SpecialiteController::class, 'index']);
    Route::get('totaldocteur',[DocteurController::class,'Totaldocteur']);  
    Route::post('/registerclient', [ClientController::class, 'registerClient']); 
    Route::get('Hopital/totalHopitaux', [HopitalController::class, 'TotalHopitaux']); 

Route::middleware(['auth:api','client'])->group(function (){   
    Route::post('/avis/create', [AvisController::class, 'store']);
    Route::delete('avis/{avis}', [AvisController::class, 'destroy']);
    Route::post('avis/edit/{avis}', [AvisController::class, 'update']); 
    Route::delete('client/{client}', [clientController::class, 'destroy']); 
    Route::post('/logoutClient', [UtilisateurController::class, 'logout']); 
    Route::post('client/edit/{Client}', [clientController::class, 'update']); 
    Route::get('Hopital/localite', [HopitalController::class, 'filterHopitauxparLocalite']); 
});
Route::middleware(['auth:api','Admin'])->group(function (){
    Route::post('/logoutAdmin', [UtilisateurController::class, 'logout']); 
    Route::post('/registerdocteur', [DocteurController::class, 'registerDocteur']);
    Route::delete('docteur/archive/{docteur}', [DocteurController::class, 'destroy']);
    Route::get('/liste/utilisateurs', [UtilisateurController::class, 'listeUtilisateurs']); 
     //LOCALITES 
    Route::post('/localite/create', [LocaliteController::class, 'store']);
    Route::delete('localite/{localite}', [LocaliteController::class, 'destroy']);
    Route::post('localite/edit/{localite}', [LocaliteController::class, 'update']);
    //REGIONS
    // Route::post('/Region/create', [RegionController::class, 'store']);
    Route::delete('Region/{Region}', [RegionController::class, 'destroy']);
    Route::post('Region/edit/{Region}', [RegionController::class, 'update']);
    Route::post('/Region/create', 'App\Http\Controllers\API\RegionController@store');
    //SPECIALITES
    Route::post('/specialite/create', [SpecialiteController::class, 'store']);
    Route::delete('specialite/{specialite}', [SpecialiteController::class, 'destroy']);
    Route::post('specialite/edit/{specialite}', [SpecialiteController::class, 'update']);
    //HOPITAUX
    Route::get('client', [ClientController::class, 'index']); 
    Route::post('Hopital/{hopitaux}', [HopitalController::class, 'destroy']); 
    Route::get('client/Totalclient', [clientController::class, 'Totalclient']); 
    Route::post('Hopital/create', [HopitalController::class, 'ajouterHopital']); 
    Route::post('Hopital/edit/{hopitaux}', [HopitalController::class, 'update']); 
}); 
Route::middleware(['auth:api','Docteur'])->group(function(){ 
    // Route::get('docteur/show/{docteur}', [DocteurController::class, 'show']);  
    Route::post('/logoutDocteur', [UtilisateurController::class, 'logout']); 
    Route::post('Docteur/edit/{utilisateur}', [DocteurController::class, 'update']); 
    Route::put('docteur/disponibilite/{docteur}', [DocteurController::class, 'disponibilite']); 
});
Route::get('Docteur/filtre/specialite',[DocteurController::class,'filterDocteurparspecialite']); 


