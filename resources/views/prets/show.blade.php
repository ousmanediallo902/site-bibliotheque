<!-- resources/views/prets/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Détails du Prêt</h2>
            <a href="{{ route('prets.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informations sur l'emprunt</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Date emprunt:</strong> {{ $pret->date_emprunt->format('d/m/Y') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Date retour:</strong> 
                            @if($pret->date_retour)
                                {{ $pret->date_retour->format('d/m/Y') }}
                            @else
                                <span class="badge bg-warning">En cours</span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Durée:</strong> 
                            @if($pret->date_retour)
                                {{ $pret->date_emprunt->diffInDays($pret->date_retour) }} jours
                            @else
                                {{ $pret->date_emprunt->diffInDays(now()) }} jours (en cours)
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Informations sur l'ouvrage</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Titre:</strong> {{ $pret->ouvrage->titre }}
                        </li>
                        <li class="list-group-item">
                            <strong>Auteur:</strong> {{ $pret->ouvrage->auteur}}
                        </li>
                        <li class="list-group-item">
                            <strong>Bibliothèque:</strong> {{ $pret->ouvrage->bibliotheque->nom }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Informations sur l'étudiant</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Nom:</strong> {{ $pret->etudiant->nom }}
                        </li>
                        <li class="list-group-item">
                            <strong>Université:</strong> {{ $pret->etudiant->universite }}
                        </li>
                        <li class="list-group-item">
                            <strong>Emprunts actuels:</strong> {{ $pret->etudiant->nbreEmprunts }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-4">
                @if(!$pret->date_retour)
                    <a href="{{ route('prets.edit', $pret->id) }}" class="btn btn-success">
                        <i class="fas fa-undo"></i> Enregistrer retour
                    </a>
                    <form action="{{ route('prets.destroy', $pret->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Annuler ce prêt ?')">
                            <i class="fas fa-times"></i> Annuler prêt
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection