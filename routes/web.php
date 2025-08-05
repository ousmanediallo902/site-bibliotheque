<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\OuvrageController;
use App\Http\Controllers\PretController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\EmployeController;





Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('etudiants', EtudiantController::class);
Route::resource('ouvrages', OuvrageController::class);
Route::resource('prets', PretController::class);
Route::resource('bibliotheques', BibliothequeController::class);
Route::resource('auteurs', AuteurController::class);
Route::resource('employes', EmployeController::class);

