<!-- resources/views/ouvrages/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Modifier l'Ouvrage</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('ouvrages.update', $ouvrage->idOuv) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="titre" class="form-label">Titre*</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="{{ $ouvrage->titre }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="auteur" class="form-label">Auteur*</label>
                        <select class="form-select" id="auteur" name="auteur" required>
                            @foreach($auteurs as $auteur)
                                <option value="{{ $auteur->idAut }}" {{ $ouvrage->auteur == $auteur->idAut ? 'selected' : '' }}>
                                    {{ $auteur->nom_auteur }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="editeur" class="form-label">Éditeur*</label>
                        <input type="text" class="form-control" id="editeur" name="editeur" value="{{ $ouvrage->editeur }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="annee" class="form-label">Année*</label>
                        <input type="number" class="form-control" id="annee" name="annee" min="1900" max="{{ date('Y') }}" value="{{ $ouvrage->annee }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="domaine" class="form-label">Domaine*</label>
                        <select class="form-select" id="domaine" name="domaine" required>
                            @foreach($domaines as $domaine)
                                <option value="{{ $domaine }}" {{ $ouvrage->domaine == $domaine ? 'selected' : '' }}>
                                    {{ $domaine }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="stock" class="form-label">Stock*</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ $ouvrage->stock }}" required>
                    </div>
                    <div class="col-md-5">
                        <label for="site" class="form-label">Bibliothèque*</label>
                        <select class="form-select" id="site" name="site" required>
                            @foreach($bibliotheques as $bibliotheque)
                                <option value="{{ $bibliotheque->nom }}" {{ $ouvrage->site == $bibliotheque->nom ? 'selected' : '' }}>
                                    {{ $bibliotheque->nom }} ({{ $bibliotheque->universite }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('ouvrages.index') }}" class="btn btn-secondary me-md-2">
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