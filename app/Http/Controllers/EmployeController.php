<?php

// app/Http/Controllers/EmployeController.php
namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Bibliotheque;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeController extends Controller
{
    /**
     * Affiche la liste des employés
     */
    public function index()
    {
        $employes = Employe::with('bibliotheque')
                         ->orderBy('nom')
                         ->paginate(10);
        
        return view('employes.index', compact('employes'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $bibliotheques = Bibliotheque::orderBy('nom')->get();
        $statuts = ['Gestionnaire', 'Bibliothécaire', 'Stagiaire'];
        
        return view('employes.create', compact('bibliotheques', 'statuts'));
    }

    /**
     * Enregistre un nouvel employé
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'statut' => 'required|string|in:Gestionnaire,Bibliothécaire,Stagiaire',
            'bibliotheque' => 'required|exists:bibliotheques,nom'
        ]);

        Employe::create($validated);

        return redirect()->route('employes.index')
                         ->with('success', 'Employé créé avec succès.');
    }

    /**
     * Affiche les détails d'un employé
     */
    public function show(Employe $employe)
    {
        return view('employes.show', compact('employe'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Employe $employe)
    {
        $bibliotheques = Bibliotheque::orderBy('nom')->get();
        $statuts = ['Gestionnaire', 'Bibliothécaire', 'Stagiaire'];
        
        return view('employes.edit', compact('employe', 'bibliotheques', 'statuts'));
    }

    /**
     * Met à jour un employé
     */
    public function update(Request $request, Employe $employe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'statut' => 'required|string|in:Gestionnaire,Bibliothécaire,Stagiaire',
            'bibliotheque' => 'required|exists:bibliotheques,nom'
        ]);

        $employe->update($validated);

        return redirect()->route('employes.index')
                         ->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Supprime un employé
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();

        return redirect()->route('employes.index')
                         ->with('success', 'Employé supprimé avec succès.');
    }
}