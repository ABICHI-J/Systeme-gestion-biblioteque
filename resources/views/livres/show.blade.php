@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Détails du livre</h1>

    @if ($errors->has('limite_emprunts'))
    <div class="alert alert-danger">{{ $errors->first('limite_emprunts') }}</div>
    @endif

    @if ($errors->has('livre_deja_emprunte'))
    <div class="alert alert-danger">{{ $errors->first('livre_deja_emprunte') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success_emprunt'))
    <div class="alert alert-success">{{ session('success_emprunt') }}</div>
    @endif

    @if(session('success_retour'))
    <div class="alert alert-success">{{ session('success_retour') }}</div>
    @endif

    <div class="text-start mb-3">
        <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Titre : {{ $livre->title }}</h5>
                <p>
                    @if ($livre->is_borrowed)
                    <span class="text-danger">Indisponible</span>
                    @else
                    <span class="text-success">Disponible</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text">Auteur : {{ $livre->author }}</p>

            @auth
            @if ($livre->is_borrowed)
            <!-- Formulaire de retour pour les livres empruntés par l'utilisateur -->
            @if (auth()->user()->emprunts()->where('book_id', $livre->id)->exists())
            <form action="{{ route('livres.retourner', $livre) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Retourner</button>
            </form>
            @endif
            @else
            <form action="{{ route('livres.emprunter', $livre) }}" method="POST">
                @csrf
                @method('POST')

                <button type="submit" class="btn btn-success">Emprunter</button>
            </form>
            @endif
            @endauth

            @if (auth()->check() && auth()->user()->roles === 1)
            <!-- Boutons pour l'administrateur -->
            <div class="mt-3">
                <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">Modifier</a>
                <form action="{{ route('livres.destroy', $livre) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection