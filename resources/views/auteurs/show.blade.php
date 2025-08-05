<!-- resources/views/auteurs/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Détails de l'Auteur</h2>
            <a href="{{ route('auteurs.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h3>{{ $auteur->nom_auteur }}</h3>
                    <p class="lead">{{ $auteur->ouvrages_count }} ouvrage(s) dans notre catalogue</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('auteurs.edit', $auteur->idAut) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('auteurs.destroy', $auteur->idAut) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if($auteur->ouvrages_count > 0)
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-book me-2"></i> Ouvrages de cet auteur
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Éditeur</th>
                                    <th>Année</th>
                                    <th>Disponibilité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auteur->ouvrages as $ouvrage)
                                <tr>
                                    <td>
                                        <a href="{{ route('ouvrages.show', $ouvrage->idOuv) }}">
                                            {{ $ouvrage->titre }}
                                        </a>
                                    </td>
                                    <td>{{ $ouvrage->editeur }}</td>
                                    <td>{{ $ouvrage->annee }}</td>
                                    <td>
                                        <span class="badge bg-{{ $ouvrage->stock > 0 ? 'success' : 'danger' }}">
                                            {{ $ouvrage->stock }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection