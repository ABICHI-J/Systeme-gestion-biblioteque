@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Créer un livre</h1>

    <div class="text-start mb-3">
        <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
    </div>

    <form action="{{ route('livres.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titre :</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Auteur :</label>
            <input type="text" name="author" id="author" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection