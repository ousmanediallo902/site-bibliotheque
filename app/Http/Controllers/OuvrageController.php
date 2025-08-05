<?php

// app/Http/Controllers/OuvrageController.php
namespace App\Http\Controllers;

use App\Models\Ouvrage;
use App\Models\Auteur;
use App\Models\Bibliotheque;
use Illuminate\Http\Request;

class OuvrageController extends Controller
{
    /**
     * Affiche la liste des ouvrages
     */
    public function index()
    {
        $ouvrages = Ouvrage::with(['auteur', 'bibliotheque'])
                         ->orderBy('titre')
                         ->paginate(10);
        
        return view('ouvrages.index', compact('ouvrages'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $auteurs = Auteur::orderBy('nom_auteur')->get();
        $bibliotheques = Bibliotheque::orderBy('nom')->get();
        $domaines = ['Informatique', 'Mathématiques', 'Physique', 'Chimie', 'Médecine', 'Littérature', 'Histoire'];
        
        return view('ouvrages.create', compact('auteurs', 'bibliotheques', 'domaines'));
    }

    /**
     * Enregistre un nouvel ouvrage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|exists:auteurs,idAut',
            'editeur' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'domaine' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'site' => 'required|exists:bibliotheques,nom'
        ]);

        Ouvrage::create($validated);

        return redirect()->route('ouvrages.index')
                         ->with('success', 'Ouvrage ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un ouvrage
     */
    public function show(Ouvrage $ouvrage)
    {
        return view('ouvrages.show', compact('ouvrage'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Ouvrage $ouvrage)
    {
        $auteurs = Auteur::orderBy('nom_auteur')->get();
        $bibliotheques = Bibliotheque::orderBy('nom')->get();
        $domaines = ['Informatique', 'Mathématiques', 'Physique', 'Chimie', 'Médecine', 'Littérature', 'Histoire'];
        
        return view('ouvrages.edit', compact('ouvrage', 'auteurs', 'bibliotheques', 'domaines'));
    }

    /**
     * Met à jour un ouvrage
     */
    public function update(Request $request, Ouvrage $ouvrage)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|exists:auteurs,idAut',
            'editeur' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'domaine' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'site' => 'required|exists:bibliotheques,nom'
        ]);

        $ouvrage->update($validated);

        return redirect()->route('ouvrages.index')
                         ->with('success', 'Ouvrage mis à jour avec succès.');
    }

    /**
     * Supprime un ouvrage
     */
    public function destroy(Ouvrage $ouvrage)
    {
        // Vérifier si l'ouvrage a des prêts en cours
        if ($ouvrage->prets()->whereNull('date_retour')->exists()) {
            return redirect()->back()
                             ->with('error', 'Impossible de supprimer : cet ouvrage a des prêts en cours.');
        }

        $ouvrage->delete();

        return redirect()->route('ouvrages.index')
                         ->with('success', 'Ouvrage supprimé avec succès.');
    }
}