<?php

// app/Models/Employe.php
namespace App\Models;

// app/Models/Employe.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employes';
    protected $primaryKey = 'idEmp';
    public $timestamps = false;

    protected $fillable = [
        'nom', 
        'adresse', 
        'statut', 
        'bibliotheque'
    ];

    public function bibliotheque()
    {
        return $this->belongsTo(Bibliotheque::class, 'bibliotheque', 'nom');
    }
}