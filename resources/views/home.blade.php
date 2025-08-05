<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Bienvenue à la Bibliothèque UADB</h1>
            <p class="lead">Système intégré de gestion des bibliothèques universitaires</p>
            <a href="#" class="btn btn-primary btn-lg mt-3">
                <i class="fas fa-search me-2"></i> Explorer le catalogue
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-book-reader"></i>
                </div>
                <h3>+10,000 Ouvrages</h3>
                <p>Une vaste collection couvrant tous les domaines académiques</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-university"></i>
                </div>
                <h3>Bibliothèques Mutualisées</h3>
                <p>Accès aux ressources de plusieurs universités partenaires</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>Gestion Simplifiée</h3>
                <p>Emprunts et retours facilités pour les étudiants</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-chart-bar me-2"></i> Statistiques Rapides
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <h4>{{ $ouvragesCount }}</h4>
                        <p class="text-muted">Ouvrages disponibles</p>
                    </div>
                    <div class="col-md-3">
                        <h4>{{ $etudiantsCount }}</h4>
                        <p class="text-muted">Étudiants inscrits</p>
                    </div>
                    <div class="col-md-3">
                        <h4>{{ $pretsActifsCount }}</h4>
                        <p class="text-muted">Prêts actifs</p>
                    </div>
                    <div class="col-md-3">
                        <h4>{{ $auteursCount }}</h4>
                        <p class="text-muted">Auteurs référencés</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection