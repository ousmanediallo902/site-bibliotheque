<?php

namespace App\Services;

use GuzzleHttp\Client;

class RemoteOuvrages
{
    public static function get()
    {
        $client = new Client();
        $response = $client->get('http://192.168.1.77/api/ouvrages');
        return json_decode($response->getBody(), true);
    }
}