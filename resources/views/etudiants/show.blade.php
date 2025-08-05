<!-- resources/views/etudiants/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Détails de l'Étudiant</h2>
            <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informations personnelles</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $etudiant->idEtud }}
                        </li>
                        <li class="list-group-item">
                            <strong>Nom:</strong> {{ $etudiant->nom }}
                        </li>
                        <li class="list-group-item">
                            <strong>Adresse:</strong> {{ $etudiant->adresse }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Informations académiques</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Université:</strong> {{ $etudiant->universite }}
                        </li>
                        <li class="list-group-item">
                            <strong>Spécialité:</strong> {{ $etudiant->specialite }}
                        </li>
                        <li class="list-group-item">
                            <strong>Emprunts actuels:</strong> {{ $etudiant->nbreEmprunts }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('etudiants.edit', $etudiant->idEtud) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <form action="{{ route('etudiants.destroy', $etudiant->idEtud) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection