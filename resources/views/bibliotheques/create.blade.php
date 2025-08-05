<!-- resources/views/bibliotheques/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Ajouter une Bibliothèque</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('bibliotheques.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom*</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                        <div class="form-text">Nom unique de la bibliothèque</div>
                    </div>
                    <div class="col-md-6">
                        <label for="universite" class="form-label">Université*</label>
                        <select class="form-select" id="universite" name="universite" required>
                            <option value="">Sélectionnez...</option>
                            @foreach($universites as $universite)
                                <option value="{{ $universite }}">{{ $universite }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('bibliotheques.index') }}" class="btn btn-secondary me-md-2">
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