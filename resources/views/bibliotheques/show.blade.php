<!-- resources/views/bibliotheques/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Détails de la Bibliothèque</h2>
            <a href="{{ route('bibliotheques.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3>{{ $bibliotheque->nom }}</h3>
                    <p class="lead">{{ $bibliotheque->universite }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('bibliotheques.edit', $bibliotheque->nom) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('bibliotheques.destroy', $bibliotheque->nom) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-book me-2"></i> Statistiques des Ouvrages
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <h4>{{ $bibliotheque->ouvrages_count }}</h4>
                                    <p class="text-muted">Total ouvrages</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>{{ $bibliotheque->ouvrages()->where('stock', '>', 0)->count() }}</h4>
                                    <p class="text-muted">Ouvrages disponibles</p>
                                </div>
                            </div>
                            <a href="{{ route('ouvrages.index', ['site' => $bibliotheque->nom]) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                                Voir tous les ouvrages
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-users me-2"></i> Statistiques des Employés
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h4>{{ $bibliotheque->employes_count }}</h4>
                                    <p class="text-muted">Employés affectés</p>
                                </div>
                            </div>
                            <a href="{{ route('employes.index', ['bibliotheque' => $bibliotheque->nom]) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                                Voir tous les employés
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection