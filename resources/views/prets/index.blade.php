<!-- resources/views/prets/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Gestion des Prêts</h2>
            <a href="{{ route('prets.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouveau prêt
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Ouvrage</th>
                            <th>Étudiant</th>
                            <th>Date emprunt</th>
                            <th>Date retour</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prets as $pret)
                        <tr>
                            <td>{{ $pret->ouvrage->titre ?? 'Ouvrage inconnu' }}</td>
                            <td>{{ $pret->etudiant->nom ?? 'Étudiant inconnu' }}</td>
                            <td>{{ $pret->date_emprunt_fr }}</td>
                            <td>
                                @if($pret->date_retour)
                                {{ $pret->date_retour_fr }}
                                @else
                                <span class="badge bg-warning">En cours</span>
                                @endif
                            </td>
                            <td>
                                @if($pret->date_retour)
                                <span class="badge bg-success">Retourné</span>
                                @else
                                <span class="badge bg-primary">Actif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('prets.show', $pret->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$pret->date_retour)
                                <a href="{{ route('prets.edit', $pret->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-undo"></i>
                                </a>
                                <form action="{{ route('prets.destroy', $pret->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Annuler ce prêt ?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $prets->links() }}
            </div>
        </div>
    </div>
</div>
@endsection