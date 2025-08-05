<!-- resources/views/etudiants/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Ajouter un Étudiant</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('etudiants.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="col-md-6">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="universite" class="form-label">Université</label>
                        <select class="form-select" id="universite" name="universite" required>
                            <option value="">Sélectionnez...</option>
                            @foreach($universites as $universite)
                                <option value="{{ $universite }}">{{ $universite }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="specialite" class="form-label">Spécialité</label>
                        <input type="text" class="form-control" id="specialite" name="specialite" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nbreEmprunts" class="form-label">Nombre max d'emprunts</label>
                    <input type="number" class="form-control" id="nbreEmprunts" name="nbreEmprunts" min="0" max="5" value="3" required>
                    <div class="form-text">Nombre maximum d'ouvrages pouvant être empruntés simultanément (0-5)</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-arrow-left"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection