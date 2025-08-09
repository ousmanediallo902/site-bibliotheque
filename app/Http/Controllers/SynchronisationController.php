<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Ouvrage;
use Illuminate\Support\Facades\Log;


class SynchronisationController extends Controller
{
    public function envoyerTousLesOuvrages($ipCible)
    {
        $ouvrages = Ouvrage::all();
        $client = new Client();

        foreach ($ouvrages as $ouvrage) {
            try {
                $client->post("http://$ipCible:8000/api/ouvrages", [
                    'form_params' => [
                        'titre' => $ouvrage->titre,
                        'auteur' => $ouvrage->auteur,
                        'editeur' => $ouvrage->editeur,
                        'annee' => $ouvrage->annee,
                        'domaine' => $ouvrage->domaine,
                        'stock' => $ouvrage->stock,
                        'site' => $ouvrage->site,
                    ]
                ]);
            } catch (\Exception $e) {
                Log::error("Erreur d'envoi : " . $e->getMessage());
            }
        }

        return response()->json(['message' => 'Ouvrages envoyés à la VM cible.']);
    }

    public function recevoirOuvrages($ipSource)
    {
        $client = new Client();
        try {
            $response = $client->get("http://$ipSource:8000/api/ouvrages");
            $ouvrages = json_decode($response->getBody(), true);
            return view('ouvrages.recus', ['ouvrages' => $ouvrages]);
        } catch (\Exception $e) {
            Log::error("Erreur de réception : " . $e->getMessage());
            return view('ouvrages.recus', ['ouvrages' => []]);
        }
    }
}

