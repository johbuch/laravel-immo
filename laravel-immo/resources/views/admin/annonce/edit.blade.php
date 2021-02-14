@extends('base')
@section('content')
    <main class="container main">
        <h2>Modifier une annonce</h2>
        <div class="d-flex justify-content-end mt-4 mb-4">
            <a href="{{ route('admin_annonces_browse')  }}"><button type="button" class="btn btn-primary">Retour</button></a>
        </div>

        <form action="{{ route('admin_annonces_update', $annonce->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="ref_annonce">Référence annonce</label>
                <input type="text" class="form-control" id="ref_annonce" name="ref_annonce" value="{{ $annonce->ref_annonce }}" placeholder="Référence annonce">
                <span class="text-danger">@error('ref_annonce'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="prix_annonce">Prix</label>
                <input type="number" step="0.01" class="form-control" id="prix_annonce" name="prix_annonce" value="{{ $annonce->prix_annonce }}" placeholder="Prix">
                <span class="text-danger">@error('prix_annonce'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="surface_habitable">Surface habitable (en m²)</label>
                <input type="number" step="0.01" class="form-control" id="surface_habitable" name="surface_habitable" value="{{ $annonce->surface_habitable }}" placeholder="Surface habitable">
                <span class="text-danger">@error('surface_habitable'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="nombre_de_piece">Nombre de pièce</label>
                <input type="number" class="form-control" id="nombre_de_piece" name="nombre_de_piece" value="{{ $annonce->nombre_de_piece }}" placeholder="Nombre de pièce">
                <span class="text-danger">@error('nombre_de_piece'){{ $message }}@enderror</span>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </main>
@endsection
