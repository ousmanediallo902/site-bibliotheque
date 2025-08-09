<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OuvrageController;
use App\Models\Ouvrage;



Route::get('/ouvrages', function () {
    return Ouvrage::all();  // ou with(['auteur', 'bibliotheque']) si tu veux les relations
});

Route::post('/ouvrages', function (Request $request) {
    return Ouvrage::create($request->all());
});