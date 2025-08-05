<!-- resources/views/auteurs/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Modifier l'Auteur</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('auteurs.update', $auteur->idAut) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom_auteur" class="form-label">Nom complet*</label>
                    <input type="text" class="form-control" id="nom_auteur" name="nom_auteur" 
                           value="{{ $auteur->nom_auteur }}" required>
                    <div class="form-text">Nom complet de l'auteur</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('auteurs.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-arrow-left"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection