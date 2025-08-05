<?php

// app/Models/Auteur.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    protected $table = 'auteurs';
    protected $primaryKey = 'idAut';
    public $timestamps = false;

    protected $fillable = [
        'nom_auteur'
    ];

    public function ouvrages()
    {
        return $this->hasMany(Ouvrage::class, 'auteur', 'idAut');
    }
}