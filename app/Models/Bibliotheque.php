<?php

// app/Models/Bibliotheque.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bibliotheque extends Model
{
    protected $table = 'bibliotheques';
    protected $primaryKey = 'nom';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'universite'
    ];

    public function employes()
    {
        return $this->hasMany(Employe::class, 'bibliotheque', 'nom');
    }

    public function ouvrages()
    {
        return $this->hasMany(Ouvrage::class, 'site', 'nom');
    }
}
