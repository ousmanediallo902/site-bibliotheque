<!-- resources/views/ouvrages/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Détails de l'Ouvrage</h2>
            <a href="{{ route('ouvrages.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ $ouvrage->titre }}</h3>
                    <p class="text-muted">Par {{ $ouvrage->auteur->nom_auteur }}</p>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations générales</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Éditeur:</strong> {{ $ouvrage->editeur }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Année:</strong> {{ $ouvrage->annee }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Domaine:</strong> {{ $ouvrage->domaine }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Disponibilité</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Stock:</strong> 
                                    <span class="badge bg-{{ $ouvrage->stock > 0 ? 'success' : 'danger' }}">
                                        {{ $ouvrage->stock }} disponible(s)
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Bibliothèque:</strong> {{ $ouvrage->bibliotheque->nom }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Université:</strong> {{ $ouvrage->bibliotheque->universite }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Actions</h5>
                        </div>
                        <div class="card-body text-center">
                            <a href="{{ route('ouvrages.edit', $ouvrage->idOuv) }}" class="btn btn-warning mb-2 w-100">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('ouvrages.destroy', $ouvrage->idOuv) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Êtes-vous sûr ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection