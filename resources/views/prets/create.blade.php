<!-- resources/views/prets/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Nouveau Prêt</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('prets.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="etud" class="form-label">Étudiant*</label>
                        <select class="form-select" id="etud" name="etud" required>
                            <option value="">Sélectionnez un étudiant...</option>
                            @foreach($etudiants as $etudiant)
                            <option value="{{ $etudiant->idEtud }}">
                                {{ $etudiant->nom }} ({{ $etudiant->universite }})
                                - Emprunts: {{ $etudiant->nbreEmprunts }}/{{ $etudiant->nbreEmpruntsMax }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="ouvg" class="form-label">Ouvrage*</label>
                        <select class="form-select" id="ouvg" name="ouvg" required>
                            <option value="">Sélectionnez un ouvrage...</option>
                            @foreach($ouvrages as $ouvrage)
                            <option value="{{ $ouvrage['idOuv']}}" data-stock="{{ $ouvrage['stock'] }}">
                                {{ $ouvrage['titre'] }} ({{ $ouvrage['auteur'] }})
                                - Stock: {{ $ouvrage['stock'] }}
                                - Source: {{ $ouvrage['site'] }}

                            </option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date_emprunt" class="form-label">Date d'emprunt*</label>
                        <input type="date" class="form-control" id="date_emprunt" name="date_emprunt"
                            value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('prets.index') }}" class="btn btn-secondary me-md-2">
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

<script>
    // Validation côté client
    document.getElementById('ouvg').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stock = selectedOption.getAttribute('data-stock');

        if (parseInt(stock) <= 0) {
            alert('Cet ouvrage n\'est plus disponible en stock.');
            this.value = '';
        }
    });
</script>
@endsection