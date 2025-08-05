<!-- resources/views/prets/retour.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Enregistrer un Retour</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('prets.update', $pret) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Ouvrage</label>
                        <input type="text" class="form-control" value="{{ $pret->ouvrage->titre }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Étudiant</label>
                        <input type="text" class="form-control" value="{{ $pret->etudiant->nom }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Date emprunt</label>
                        <input type="text" class="form-control" value="{{ $pret->date_emprunt->format('d/m/Y') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="date_retour" class="form-label">Date retour*</label>
                        <input type="date" class="form-control" id="date_retour" name="date_retour" 
                               value="{{ date('Y-m-d') }}" 
                               min="{{ $pret->date_emprunt->format('Y-m-d') }}" 
                               max="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('prets.show', $pret) }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-arrow-left"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Valider retour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection