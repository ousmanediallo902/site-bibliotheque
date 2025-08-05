<!-- resources/views/bibliotheques/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Gestion des Bibliothèques</h2>
            <a href="{{ route('bibliotheques.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter une bibliothèque
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
                            <th>Nom</th>
                            <th>Université</th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bibliotheques as $bibliotheque)
                        <tr>
                            <td>{{ $bibliotheque->nom }}</td>
                            <td>{{ $bibliotheque->universite }}</td>
                            
                            <td>
                                <a href="{{ route('bibliotheques.show', $bibliotheque->nom) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('bibliotheques.edit', $bibliotheque->nom) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('bibliotheques.destroy', $bibliotheque->nom) }}" method="POST" style="display:inline;">
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
                {{ $bibliotheques->links() }}
            </div>
        </div>
    </div>
</div>
@endsection