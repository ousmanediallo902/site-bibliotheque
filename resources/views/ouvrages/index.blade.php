<!-- resources/views/ouvrages/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Catalogue des Ouvrages</h2>
            <div>
                <a href="{{ route('ouvrages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter un ouvrage
                </a>
            </div>
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
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Éditeur</th>
                            <th>Domaine</th>
                            <th>Stock</th>
                            <th>Bibliothèque</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ouvrages as $ouvrage)
                        <tr>
                            <td>{{ $ouvrage->titre }}</td>
                            <td>{{ $ouvrage->auteur }}</td>
                            <td>{{ $ouvrage->editeur }}</td>
                            <td>{{ $ouvrage->domaine }}</td>
                            <td>
                                <span class="badge bg-{{ $ouvrage->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $ouvrage->stock }}
                                </span>
                            </td>
                            <td>{{ $ouvrage->bibliotheque->nom }}</td>
                            <td>
                                <a href="{{ route('ouvrages.show', $ouvrage->idOuv) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('ouvrages.edit', $ouvrage->idOuv) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('ouvrages.destroy', $ouvrage->idOuv) }}" method="POST" style="display:inline;">
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
                {{ $ouvrages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection