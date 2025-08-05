<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Ouvrage;
use App\Models\Etudiant;
use App\Models\Pret;
use App\Models\Auteur;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'ouvragesCount' => Ouvrage::count(),
            'etudiantsCount' => Etudiant::count(),
            'pretsActifsCount' => Pret::whereNull('date_retour')->count(),
            'auteursCount' => Auteur::count(),
        ];

        return view('home', $stats);
    }
}