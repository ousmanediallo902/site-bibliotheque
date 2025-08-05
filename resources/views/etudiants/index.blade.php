<!-- resources/views/etudiants/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Liste des Étudiants</h2>
            <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un étudiant
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
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Université</th>
                            <th>Spécialité</th>
                            <th>Emprunts</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                        <tr>
                            <td>{{ $etudiant->idEtud }}</td>
                            <td>{{ $etudiant->nom }}</td>
                            <td>{{ $etudiant->universite }}</td>
                            <td>{{ $etudiant->specialite }}</td>
                            <td>{{ $etudiant->nbreEmprunts }}</td>
                            <td>
                                <a href="{{ route('etudiants.show', $etudiant->idEtud) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('etudiants.edit', $etudiant->idEtud) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('etudiants.destroy', $etudiant->idEtud) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $etudiants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection