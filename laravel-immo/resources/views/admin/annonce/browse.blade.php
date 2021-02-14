@extends('base')
@section('content')
    <main class="container main">
        <h2>Espace administration du site</h2>
        <div class="d-flex justify-content-end mt-4 mb-4">
            <a href="{{ route('admin_annonces_add')  }}"><button type="button" class="btn btn-primary">Ajouter une nouvelle annonce</button></a>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="main__table table table-hover">
            <thead>
                <tr>
                    <th scope="col">@sortablelink('id', 'Id')</th>
                    <th scope="col">@sortablelink('ref_annonce', 'Ref Annonce')</th>
                    <th scope="col">@sortablelink('prix_annonce', 'Prix Annonce')</th>
                    <th scope="col">@sortablelink('surface_habitable', 'Surface Habitable')</th>
                    <th scope="col">@sortablelink('nombre_de_piece', 'Nombre de pièce')</th>
                    <th scope="col">@sortablelink('created_at', 'Created At')</th>
                    <th scope="col">@sortablelink('updated_at', 'Updated At')</th>
                    <th scope="col" width="150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($annonces->count())
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
                                <a href="{{ route('admin_annonces_edit', $annonce->id) }}"><button type="button" class="main__action btn btn-primary"><i class="fas fa-edit"></i></button></a>
                                <form method="POST" action="{{ route('admin_annonces_delete', $annonce->id) }}" class="main__action" id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="pagination">
            {!! $annonces->appends(\Request::except('page'))->render() !!}
        </div>
    </main>
@endsection
