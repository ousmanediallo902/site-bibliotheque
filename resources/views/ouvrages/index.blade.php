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

            <!-- Onglets pour UAD/UGB -->
            <ul class="nav nav-tabs mb-4" id="ouvragesTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="uad-tab" data-bs-toggle="tab" data-bs-target="#uad" type="button" role="tab">
                        Ouvrages UADB
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ugb-tab" data-bs-toggle="tab" data-bs-target="#ugb" type="button" role="tab">
                        Ouvrages UGB
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="ouvragesTabContent">
                <!-- Onglet UAD -->
                <div class="tab-pane fade show active" id="uad" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Éditeur</th>
                                    <th>Domaine</th>
                                    <th>Stock</th>
                                    <th>Année</th>
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
                                    <td>{{ $ouvrage->annee}}</td>
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

                <!-- Onglet UGB -->
                <div class="tab-pane fade" id="ugb" role="tabpanel">
                    @if(isset($remoteOuvrages) && count($remoteOuvrages) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                       <th>Titre</th>
                                       <th>Auteur</th>
                                       <th>Éditeur</th>
                                       <th>Année</th>
                                       <th>Domaine</th>
                                       <th>Stock</th>
                
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($remoteOuvrages as $ouvrage)
                                    <tr>
                                        <td>{{ $ouvrage['titre'] ?? '' }}</td>
                                        <td>{{ $ouvrage['auteur']['nom_auteur'] ?? '' }}</td>
                                        <td>{{ $ouvrage['editeur'] ?? '' }}</td>
                                         <td>{{ $ouvrage['annee'] ?? '' }}</td>
                                         <td>{{ $ouvrage['domaine'] ?? '' }}</td>
      
                                        <td>
                                            <span class="badge bg-{{ $ouvrage['stock'] > 0 ? 'success' : 'danger' }}">
                                                {{ $ouvrage['stock'] }}
                                            </span>
                                        </td>
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">Aucun ouvrage disponible à l'UGB pour le moment.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript pour gérer les onglets -->
@section('scripts')
<script>
    // Active Bootstrap tabs
    var tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabElms.forEach(function(tabEl) {
        tabEl.addEventListener('click', function (event) {
            event.preventDefault();
            var tab = new bootstrap.Tab(tabEl);
            tab.show();
        });
    });
</script>
@endsection
@endsection