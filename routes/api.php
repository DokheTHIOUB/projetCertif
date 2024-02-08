<?php

use FFI\CData;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AvisController;
use App\Http\Controllers\API\RdvControlleur;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\DocteurController;
use App\Http\Controllers\API\HopitalController;
use App\Http\Controllers\API\LocaliteController;
use App\Http\Controllers\API\SpecialiteController;
use App\Http\Controllers\API\UtilisateurController;
use App\Http\Controllers\API\DocteurHopitalController;
use App\Http\Middleware\Docteur;

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

Route::get('/listerDocteurHopital', [DocteurHopitalController::class, 'listeRdv']); 


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
    Route::delete('avis/{avis}', [AvisController::class, 'destroy']);
    Route::post('avis/edit/{avis}', [AvisController::class, 'update']); 
    Route::delete('client/{Client}', [clientController::class, 'destroy']); 
    Route::post('/logoutClient', [UtilisateurController::class, 'logout']); 
    Route::post('client/edit/{Client}', [clientController::class, 'update']); 
    Route::get('Hopital/localite', [HopitalController::class, 'filterHopitauxparLocalite']); 

    Route::post('/ajouter/rdv', [RdvControlleur::class, 'store']); 
    Route::post('/rdv/uptade/{rdv}', [RdvControlleur::class, 'update']);
    Route::delete('/rdv/delete/{rdv}', [RdvControlleur::class, 'destroy']); 

    Route::get('Docteur/filtre/specialite',[DocteurController::class,'filterDocteurparspecialite']); 
    Route::post('docteur/disponible', [DocteurController::class, 'Docteurdisponible']);
    Route::post('docteur/indisponible', [DocteurController::class, 'DocteurIndisponible']);


});
Route::middleware(['auth:api','admin'])->group(function (){
    Route::post('/logoutAdmin', [UtilisateurController::class, 'logout']); 
    Route::post('/registerdocteur', [DocteurController::class, 'registerDocteur']);
    Route::get('/liste/utilisateurs', [UtilisateurController::class, 'listeUtilisateurs']); 
    Route::get('/ajoutDocteurHopital', [DocteurHopitalController::class, 'store']); 
    Route::get('/update/{DocteurHopital}', [DocteurHopitalController::class, 'update']); 
    
    Route::delete('docteur/archive/{Docteur}', [DocteurController::class, 'destroy']);
   
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
    Route::post('hopital/create', [HopitalController::class, 'ajouterHopital']); 
    Route::post('Hopital/edit/{hopitaux}', [HopitalController::class, 'update']); 
}); 
Route::middleware(['auth:api','docteur'])->group(function(){ 
    // Route::get('docteur/show/{docteur}', [DocteurController::class, 'show']);  
    Route::post('/logoutDocteur', [UtilisateurController::class, 'logout']); 
   
    Route::get('/rdv', [RdvControlleur::class, 'listeRdv']); 
    Route::get('/rdv/confirmer', [RdvControlleur::class, 'listeRdvConfirmer']); 
    Route::get('/rdv/annuler', [RdvControlleur::class, 'listeRdvAnnuler']); 
    Route::get('/rdv/en_attente', [RdvControlleur::class, 'listeRdvEnAttente']); 
    Route::put('rdv/etat/{rdv}', [DocteurController::class, 'Statut']); 
    Route::get('rdv/filtre/date',[DocteurController::class,'Rechercheenfonctiondesdates']); 

    Route::post('Docteur/edit/{utilisateur}', [DocteurController::class, 'update']); 
    Route::patch('docteur/disponibilite/{Docteur}', [DocteurController::class, 'Statut']); 
   
});
