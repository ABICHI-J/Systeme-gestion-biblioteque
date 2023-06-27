@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Liste des livres</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (auth()->check() && auth()->user()->roles === 1)
            <a href="{{ route('livres.create') }}" class="btn btn-success mb-3">Créer un livre</a>
            @endif

            <div class="row">
                @foreach ($livres as $livre)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $livre->title }}</h5>
                            <p class="card-text">{{ $livre->description }}</p>
                            <a href="{{ route('livres.show', $livre) }}" class="btn btn-primary">Voir le livre</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection