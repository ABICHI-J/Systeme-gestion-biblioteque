@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="text-center">Bienvenue sur notre site</h1>

        <div class="text-center mt-4">
            <h5>Découvrez notre collection de livres</h5>
            <p>Parcourez notre sélection de livres et trouvez votre prochaine lecture.</p>
            <a href="{{ route('livres.index') }}" class="btn btn-primary">Voir les livres</a>
        </div>
    </div>
</div>
@endsection