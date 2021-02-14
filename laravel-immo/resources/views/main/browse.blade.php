@extends('base')
@section('content')
    <main class="container main">
        <h2 class="text-center">Découvrez toutes nos annonces</h2>
        <div class="row">
            @foreach($annonces as $annonce)
                <div class="col-4">
                    <div class="main__card card border-info mb-3">
                        <img class="card-img-top" src="https://picsum.photos/100" alt="Card image cap">
                        <div class="card-body">
                            <div>Référence : {{ $annonce->ref_annonce }}</div>
                            <div>Prix : {{ $annonce->prix_annonce }} €</div>
                            <div>Surface habitable : {{ $annonce->surface_habitable }}m²</div>
                            <div>Nombre de pièces: {{ $annonce->nombre_de_piece }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
