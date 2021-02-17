@extends('base')
@section('content')
    <main class="container main">
        <h2>Espace administration du site</h2>
        <!-- bouton pour afficher la modal -->
        <div class="d-flex justify-content-end mt-4 mb-4">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#addAnnonceModal" class="btn btn-primary">Ajouter une nouvelle annonce</a>
        </div>

        {{-- affichage des messages de succès lorsqu'il y en a un à afficher --}}
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="main__table table table-hover">
            <thead>
            <tr>
                {{-- utilisation de @sortablelink pour avoir le tri des colonnes --}}
{{--                <th scope="col">@sortablelink('id', 'Id')</th>--}}
{{--                <th scope="col">@sortablelink('ref_annonce', 'Ref Annonce')</th>--}}
{{--                <th scope="col">@sortablelink('prix_annonce', 'Prix Annonce')</th>--}}
{{--                <th scope="col">@sortablelink('surface_habitable', 'Surface Habitable')</th>--}}
{{--                <th scope="col">@sortablelink('nombre_de_piece', 'Nombre de pièce')</th>--}}
{{--                <th scope="col">@sortablelink('created_at', 'Created At')</th>--}}
{{--                <th scope="col">@sortablelink('updated_at', 'Updated At')</th>--}}
{{--                <th scope="col" width="150px">Actions</th>--}}
                <th scope="col">Id</th>
                <th scope="col">Ref Annonce</th>
                <th scope="col">Prix Annonce</th>
                <th scope="col">Surface Habitable</th>
                <th scope="col">Nombre de pièce</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col" width="150px">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($annonces->count())
                {{-- boucle sur le tableau pour récupérer chaque ligne --}}
                @foreach($annonces as $annonce)
                    <tr class="table-light" data-id="{{ $annonce->id }}">
                        <th scope="row">{{ $annonce->id }}</th>
                        <td data-ref="ref">{{ $annonce->ref_annonce }}</td>
                        <td data-prix="prix">{{ $annonce->prix_annonce }}</td>
                        <td data-surface="surface">{{ $annonce->surface_habitable }}</td>
                        <td data-piece="piece">{{ $annonce->nombre_de_piece }}</td>
                        <td data-created="created-at">{{ $annonce->created_at }}</td>
                        <td data-updated="updated-at">{{ $annonce->updated_at }}</td>
                        <td>
                            <a href="{{ route('api_annonces_show', $annonce->id) }}" data-toggle="modal" data-target="#editAnnonceModal" class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('api_annonces_delete', $annonce->id) }}" class="main__action btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif

            <template id="template-annonce">
                <tr class="table-light line-template" data-id="">
                    <th scope="row" class="annonce-id"></th>
                    <td class="annonce-ref" data-ref="ref"></td>
                    <td class="annonce-prix" data-prix="prix"></td>
                    <td class="annonce-surface" data-surface="surface"></td>
                    <td class="annonce-piece" data-piece="piece"></td>
                    <td class="annonce-created-at" data-created="created-at" ></td>
                    <td class="annonce-updated-at" data-updated="updated-at"></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#editAnnonceModal" class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></a>
                        <a href="" class="main__action btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>

        <!-- Modal ADD annonce-->
        <div class="modal fade" id="addAnnonceModal" tabindex="-1" aria-labelledby="addAnnonceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnnonceModalLabel">Ajouter une nouvelle annonce</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="addForm">
                            @csrf
                            <div class="form-group">
                                <label for="ref_annonce">Référence annonce</label>
                                <input type="text" class="form-control ref-annonce" id="ref_annonce" name="ref_annonce" value="" placeholder="Référence annonce">
                                <span class="text-danger">@error('ref_annonce'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="prix_annonce">Prix</label>
                                <input type="number" step="0.01" class="form-control prix-annonce" id="prix_annonce" name="prix_annonce" value="" placeholder="Prix">
                                <span class="text-danger">@error('prix_annonce'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="surface_habitable">Surface habitable (en m²)</label>
                                <input type="number" step="0.01" class="form-control surface-habitable" id="surface_habitable" name="surface_habitable" value="" placeholder="Surface habitable">
                                <span class="text-danger">@error('surface_habitable'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="nombre_de_piece">Nombre de pièce</label>
                                <input type="number" class="form-control nombre-de-piece" id="nombre_de_piece" name="nombre_de_piece" value="" placeholder="Nombre de pièce">
                                <span class="text-danger">@error('nombre_de_piece'){{ $message }}@enderror</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal EDIT annonce-->
        <div class="modal fade" id="editAnnonceModal" tabindex="-1" aria-labelledby="editAnnonceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAnnonceModalLabel">Modifier l'annonce</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="ref_annonce">Référence annonce</label>
                                <input type="text" class="form-control ref-annonce" id="ref_annonce" name="ref_annonce" value="" placeholder="Référence annonce">
                                <span class="text-danger">@error('ref_annonce'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="prix_annonce">Prix</label>
                                <input type="number" step="0.01" class="form-control prix-annonce" id="prix_annonce" name="prix_annonce" value="" placeholder="Prix">
                                <span class="text-danger">@error('prix_annonce'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="surface_habitable">Surface habitable (en m²)</label>
                                <input type="number" step="0.01" class="form-control surface-habitable" id="surface_habitable" name="surface_habitable" value="" placeholder="Surface habitable">
                                <span class="text-danger">@error('surface_habitable'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="nombre_de_piece">Nombre de pièce</label>
                                <input type="number" class="form-control nombre-de-piece" id="nombre_de_piece" name="nombre_de_piece" value="" placeholder="Nombre de pièce">
                                <span class="text-danger">@error('nombre_de_piece'){{ $message }}@enderror</span>
                            </div>
                            <input type="hidden" class="annonce-id" name="annonce-id" value="">

                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="pagination">--}}
{{--            {!! $annonces->appends(\Request::except('page'))->render() !!}--}}
{{--        </div>--}}
    </main>
@endsection
