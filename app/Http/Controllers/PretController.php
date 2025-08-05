<?php

// app/Http/Controllers/PretController.php
namespace App\Http\Controllers;

use App\Models\Pret;
use App\Models\Ouvrage;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PretController extends Controller
{
    /**
     * Affiche la liste des prêts
     */
    public function index()
    {
        $prets = Pret::with(['ouvrage', 'etudiant'])
                   ->orderBy('date_emprunt', 'desc')
                   ->paginate(10);
        
        return view('prets.index', compact('prets'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $ouvrages = Ouvrage::where('stock', '>', 0)
                         ->orderBy('titre')
                         ->get();
        
        $etudiants = Etudiant::orderBy('nom')->get();
        
        return view('prets.create', compact('ouvrages', 'etudiants'));
    }

    /**
     * Enregistre un nouveau prêt
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ouvg' => 'required|exists:ouvrages,idOuv',
            'etud' => 'required|exists:etudiants,idEtud',
            'date_emprunt' => 'required|date|before_or_equal:today'
        ]);

        // Vérifier la disponibilité du stock
        $ouvrage = Ouvrage::find($validated['ouvg']);
        if ($ouvrage->stock <= 0) {
            return back()->with('error', 'Cet ouvrage n\'est plus disponible en stock.');
        }

        // Vérifier le quota d'emprunts de l'étudiant
        $etudiant = Etudiant::find($validated['etud']);
        $empruntsActifs = Pret::where('etud', $etudiant->idEtud)
                            ->whereNull('date_retour')
                            ->count();
        
        if ($empruntsActifs >= $etudiant->nbreEmprunts) {
            return back()->with('error', 'L\'étudiant a atteint son quota d\'emprunts.');
        }

        DB::transaction(function () use ($validated, $ouvrage) {
            // Créer le prêt
            Pret::create($validated);
            
            // Décrémenter le stock
            $ouvrage->decrement('stock');
            
            // Incrémenter le compteur d'emprunts de l'étudiant
            Etudiant::where('idEtud', $validated['etud'])->increment('nbreEmprunts');
        });

        return redirect()->route('prets.index')
                         ->with('success', 'Prêt enregistré avec succès.');
    }

    /**
     * Affiche les détails d'un prêt
     */
    public function show(Pret $pret)
    {
        return view('prets.show', compact('pret'));
    }

    /**
     * Marquer un retour d'ouvrage
     */
    public function edit(Pret $pret)
    {
        // On utilise edit pour marquer le retour
        if ($pret->date_retour) {
            return redirect()->route('prets.show', $pret)
                             ->with('error', 'Cet ouvrage a déjà été retourné.');
        }
        
        return view('prets.retour', compact('pret'));
    }

    /**
     * Traite le retour d'un ouvrage
     */
    public function update(Request $request, Pret $pret)
    {
        if ($pret->date_retour) {
            return back()->with('error', 'Cet ouvrage a déjà été retourné.');
        }

        $validated = $request->validate([
            'date_retour' => 'required|date|after_or_equal:date_emprunt'
        ]);

        DB::transaction(function () use ($pret, $validated) {
            // Marquer le retour
            $pret->update([
                'date_retour' => $validated['date_retour']
            ]);
            
            // Réapprovisionner le stock
            $pret->ouvrage->increment('stock');
            
            // Décrémenter le compteur d'emprunts de l'étudiant
            $pret->etudiant->decrement('nbreEmprunts');
        });

        return redirect()->route('prets.show', $pret)
                         ->with('success', 'Retour enregistré avec succès.');
    }

    /**
     * Annule un prêt (avant retour)
     */
    public function destroy(Pret $pret)
    {
        if ($pret->date_retour) {
            return back()->with('error', 'Impossible de supprimer un prêt déjà retourné.');
        }

        DB::transaction(function () use ($pret) {
            // Supprimer le prêt
            $pret->delete();
            
            // Réapprovisionner le stock
            $pret->ouvrage->increment('stock');
            
            // Décrémenter le compteur d'emprunts de l'étudiant
            $pret->etudiant->decrement('nbreEmprunts');
        });

        return redirect()->route('prets.index')
                         ->with('success', 'Prêt annulé avec succès.');
    }
}