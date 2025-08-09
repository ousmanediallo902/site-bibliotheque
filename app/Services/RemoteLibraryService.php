<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RemoteLibraryService
{
    public function getOuvrages()
    {
        try {
            $response = Http::get(config('app.remote_url').'/api/ouvrages');
            return $response->successful() ? $response->json()['data'] : [];
        } catch (\Exception $e) {
            Log::error("Erreur API: ".$e->getMessage());
            return [];
        }
    }
}