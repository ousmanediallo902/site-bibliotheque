<!-- resources/views/employes/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Ajouter un Employé</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('employes.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom complet*</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="col-md-6">
                        <label for="adresse" class="form-label">Adresse*</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="statut" class="form-label">Statut*</label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="">Sélectionnez un statut...</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}">{{ $statut }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="bibliotheque" class="form-label">Bibliothèque*</label>
                        <select class="form-select" id="bibliotheque" name="bibliotheque" required>
                            <option value="">Sélectionnez une bibliothèque...</option>
                            @foreach($bibliotheques as $bibliotheque)
                                <option value="{{ $bibliotheque->nom }}">
                                    {{ $bibliotheque->nom }} ({{ $bibliotheque->universite }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('employes.index') }}" class="btn btn-secondary me-md-2">
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