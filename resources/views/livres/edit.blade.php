@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Modifier le livre</h1>

    <div class="text-start mb-3">
        <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
    </div>

    <form action="{{ route('livres.update', $livre) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $livre->id }}">

        <div class="mb-3">
            <label for="title" class="form-label">Titre :</label>
            <input type="text" name="title" value="{{ $livre->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Auteur :</label>
            <input type="text" name="author" value="{{ $livre->author }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Modifier</button>
    </form>
</div>
@endsection