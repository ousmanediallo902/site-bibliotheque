<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pret extends Model
{
    protected $table = 'prets';
    public $timestamps = false;

    protected $fillable = [
        'ouvg',
        'etud',
        'date_emprunt',
        'date_retour'
    ];

    // Ajoutez ce casting des dates
    protected $casts = [
        'date_emprunt' => 'datetime:Y-m-d',
        'date_retour' => 'datetime:Y-m-d'
    ];

    public function ouvrage()
    {
        return $this->belongsTo(Ouvrage::class, 'ouvg', 'idOuv');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etud', 'idEtud');
    }

      public function getRouteKeyName()
    {
        return 'id'; // Utilise maintenant la colonne id
    }

    // Accesseur pour le format français
    public function getDateEmpruntFrAttribute()
    {
        return Carbon::parse($this->date_emprunt)->format('d/m/Y');
    }
    
    public function getDateRetourFrAttribute()
    {
        return $this->date_retour ? Carbon::parse($this->date_retour)->format('d/m/Y') : null;
    }
}