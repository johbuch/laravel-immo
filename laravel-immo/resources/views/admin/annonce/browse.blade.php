@extends('base')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-end mt-4 mb-4">
            <a href="{{ route('admin_annonces_add')  }}"><button type="button" class="btn btn-primary">Ajouter une nouvelle annonce</button></a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">ref_annonce</th>
                    <th scope="col">prix annonce</th>
                    <th scope="col">surface habitable</th>
                    <th scope="col">nombre de pièce</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($annonces as $annonce)
                <tr class="table-light">
                    <th scope="row">{{ $annonce->id }}</th>
                    <td>{{ $annonce->ref_annonce }}</td>
                    <td>{{ $annonce->prix_annonce }}</td>
                    <td>{{ $annonce->surface_habitable }}</td>
                    <td>{{ $annonce->nombre_de_piece }}</td>
                    <td>{{ $annonce->created_at }}</td>
                    <td>{{ $annonce->updated_at }}</td>
                    <td>
                        <form action="POST" action="">
                            <a href="{{ route('admin_annonces_edit', $annonce->id) }}"><button type="button" class="btn btn-primary">Modifier</button></a>
                            @csrf
                            <a href=""><button type="button" class="btn btn-danger">Supprimer</button></a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
