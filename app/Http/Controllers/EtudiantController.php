<?php

// app/Http/Controllers/EtudiantController.php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants
     */
    public function index()
    {
        $etudiants = Etudiant::orderBy('nom')->paginate(10);
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $universites = ['UAD']; // Liste des universités partenaires
        return view('etudiants.create', compact('universites'));
    }

    /**
     * Enregistre un nouvel étudiant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'universite' => 'required|string|in:UAD,UGB',
            'specialite' => 'required|string|max:255',
            'nbreEmprunts' => 'required|integer|min:0|max:5'
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant créé avec succès.');
    }

    /**
     * Affiche les détails d'un étudiant
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Etudiant $etudiant)
    {
        $universites = ['UAD'];
        return view('etudiants.edit', compact('etudiant', 'universites'));
    }

    /**
     * Met à jour un étudiant
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'universite' => 'required|string|in:UAD,UGB',
            'specialite' => 'required|string|max:255',
            'nbreEmprunts' => 'required|integer|min:0|max:5'
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Supprime un étudiant
     */
    public function destroy(Etudiant $etudiant)
    {
        // Vérifier si l'étudiant a des prêts en cours
        if ($etudiant->prets()->whereNull('date_retour')->exists()) {
            return redirect()->back()
                             ->with('error', 'Impossible de supprimer : l\'étudiant a des prêts en cours.');
        }

        $etudiant->delete();

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant supprimé avec succès.');
    }
}