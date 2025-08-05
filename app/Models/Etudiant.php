<?php

// app/Models/Etudiant.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $table = 'etudiants';
    protected $primaryKey = 'idEtud';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'adresse',
        'universite',
        'specialite',
        'nbreEmprunts'
    ];

    public function prets()
    {
        return $this->hasMany(Pret::class, 'etud', 'idEtud');
    }
}