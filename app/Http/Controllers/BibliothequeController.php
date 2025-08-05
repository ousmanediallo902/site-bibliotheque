<?php

// app/Http/Controllers/BibliothequeController.php
namespace App\Http\Controllers;

use App\Models\Bibliotheque;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BibliothequeController extends Controller
{
    /**
     * Affiche la liste des bibliothèques
     */
    public function index()
    {
        $bibliotheques = Bibliotheque::orderBy('nom')->paginate(10);
        return view('bibliotheques.index', compact('bibliotheques'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $universites = ['UAD', 'UGB']; // Liste des universités partenaires
        return view('bibliotheques.create', compact('universites'));
    }

    /**
     * Enregistre une nouvelle bibliothèque
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:bibliotheques,nom',
            'universite' => ['required', 'string', Rule::in(['UAD', 'UGB'])]
        ]);

        Bibliotheque::create($validated);

        return redirect()->route('bibliotheques.index')
                         ->with('success', 'Bibliothèque créée avec succès.');
    }

    /**
     * Affiche les détails d'une bibliothèque
     */
    public function show(Bibliotheque $bibliotheque)
    {
        // Charger les relations pour les statistiques
        $bibliotheque->loadCount(['ouvrages', 'employes']);
        
        return view('bibliotheques.show', compact('bibliotheque'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Bibliotheque $bibliotheque)
    {
        $universites = ['UAD', 'UGB'];
        return view('bibliotheques.edit', compact('bibliotheque', 'universites'));
    }

    /**
     * Met à jour une bibliothèque
     */
    public function update(Request $request, Bibliotheque $bibliotheque)
    {
        $validated = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bibliotheques', 'nom')->ignore($bibliotheque->nom, 'nom')
            ],
            'universite' => ['required', 'string', Rule::in(['UAD', 'UGB'])]
        ]);

        $bibliotheque->update($validated);

        return redirect()->route('bibliotheques.index')
                         ->with('success', 'Bibliothèque mise à jour avec succès.');
    }

    /**
     * Supprime une bibliothèque
     */
    public function destroy(Bibliotheque $bibliotheque)
    {
        // Vérifier les dépendances avant suppression
        if ($bibliotheque->ouvrages()->exists() || $bibliotheque->employes()->exists()) {
            return redirect()->back()
                             ->with('error', 'Impossible de supprimer : la bibliothèque contient des ouvrages ou employés.');
        }

        $bibliotheque->delete();

        return redirect()->route('bibliotheques.index')
                         ->with('success', 'Bibliothèque supprimée avec succès.');
    }
}