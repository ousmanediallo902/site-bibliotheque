<?php

// app/Models/Ouvrage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    protected $table = 'ouvrages';
    protected $primaryKey = 'idOuv';
    public $timestamps = false;

    protected $fillable = [
        'titre',
        'auteur',
        'editeur',
        'annee',
        'domaine',
        'stock',
        'site'
    ];

    public function auteur()
    {
        return $this->belongsTo(Auteur::class, 'auteur', 'idAut');
    }

    public function bibliotheque()
    {
        return $this->belongsTo(Bibliotheque::class, 'site', 'nom');
    }

    public function prets()
    {
        return $this->hasMany(Pret::class, 'ouvg', 'idOuv');
    }
}