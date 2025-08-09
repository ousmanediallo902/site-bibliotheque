<!-- resources/views/employes/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Détails de l'Employé</h2>
            <a href="{{ route('employes.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h3>{{ $employe->nom }}</h3>
                    <p class="lead">
                        <span class="badge 
                            @if($employe->statut == 'Gestionnaire') bg-success
                            @elseif($employe->statut == 'Bibliothécaire') bg-primary
                            @else bg-secondary
                            @endif">
                            {{ $employe->statut }}
                        </span>
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('employes.edit', $employe->idEmp) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('employes.destroy', $employe->idEmp) }}" method="POST">
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
                            <i class="fas fa-info-circle me-2"></i> Informations personnelles
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Adresse:</strong> {{ $employe->adresse }}
                                </li>
                                <li class="list-group-item">
                                    <strong>ID Employé:</strong> {{ $employe->idEmp }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-university me-2"></i> Affectation
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Bibliothèque:</strong> {{ $employe->bibliotheque }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Statut:</strong> {{ $employe->statut }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection