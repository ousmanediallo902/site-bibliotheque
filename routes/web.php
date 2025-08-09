<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\OuvrageController;
use App\Http\Controllers\PretController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\SynchronisationController;





Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('etudiants', EtudiantController::class);
Route::resource('ouvrages', OuvrageController::class);
Route::resource('prets', PretController::class);
Route::resource('bibliotheques', BibliothequeController::class);
Route::resource('auteurs', AuteurController::class);
Route::resource('employes', EmployeController::class);



// VM2 envoie à VM1
Route::get('/envoyer-vers-vm1', function () {
    return app(SynchronisationController::class)->envoyerTousLesOuvrages('172.20.10.2');
});

// Voir les ouvrages de la VM1
Route::get('/ouvrages-vm1', function () {
    return app(SynchronisationController::class)->recevoirOuvrages('172.20.10.2');
});


Route::get('/api/ouvrages', function() {
    return response()->json(App\Models\Ouvrage::with('auteur')->get());
});

//Route::get('/ouvrages', [OuvrageController::class, 'apiIndex']);