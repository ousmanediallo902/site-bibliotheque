<?php

// app/Http/Controllers/AuteurController.php
namespace App\Http\Controllers;
use Illuminate\Validation\Rule;


use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    /**
     * Affiche la liste des auteurs
     */
    public function index()
{
    $auteurs = Auteur::withCount('ouvrages') // Charge le nombre d'ouvrages
                   ->orderBy('nom_auteur')
                   ->paginate(10);
                   
    return view('auteurs.index', compact('auteurs'));
}
    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('auteurs.create');
    }

    /**
     * Enregistre un nouvel auteur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_auteur' => 'required|string|max:255|unique:auteurs,nom_auteur'
        ]);

        Auteur::create($validated);

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur créé avec succès.');
    }

    /**
     * Affiche les détails d'un auteur
     */
    public function show(Auteur $auteur)
    {
        $auteur->loadCount('ouvrages');
        return view('auteurs.show', compact('auteur'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Auteur $auteur)
    {
        return view('auteurs.edit', compact('auteur'));
    }

    /**
     * Met à jour un auteur
     */
    public function update(Request $request, Auteur $auteur)
    {
        $validated = $request->validate([
            'nom_auteur' => [
                'required',
                'string',
                'max:255',
                Rule::unique('auteurs', 'nom_auteur')->ignore($auteur->idAut, 'idAut')
            ]
        ]);

        $auteur->update($validated);

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur mis à jour avec succès.');
    }

    /**
     * Supprime un auteur
     */
    public function destroy(Auteur $auteur)
    {
        if ($auteur->ouvrages()->exists()) {
            return redirect()->back()
                             ->with('error', 'Impossible de supprimer : cet auteur a des ouvrages associés.');
        }

        $auteur->delete();

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur supprimé avec succès.');
    }
}