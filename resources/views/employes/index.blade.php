<!-- resources/views/employes/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Gestion des Employés</h2>
            <a href="{{ route('employes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un employé
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Statut</th>
                            <th>Bibliothèque</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employes as $employe)
                        <tr>
                            <td>{{ $employe->nom }}</td>
                            <td>
                                <span class="badge 
                                    @if($employe->statut == 'Gestionnaire') bg-success
                                    @elseif($employe->statut == 'Bibliothécaire') bg-primary
                                    @else bg-secondary
                                    @endif">
                                    {{ $employe->statut }}
                                </span>
                            </td>
                            <td>{{ $employe->bibliotheque ?? 'Non attribué'}}</td>
                            <td>{{ $employe->adresse  ?? 'Non disponible'}}</td>
                            <td>
                                <a href="{{ route('employes.show', $employe->idEmp) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employes.edit', $employe->idEmp) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('employes.destroy', $employe->idEmp) }}" method="POST" style="display:inline;">
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
                {{ $employes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection