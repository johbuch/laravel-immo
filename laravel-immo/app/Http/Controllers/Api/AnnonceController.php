<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Http\Resources\Annonce as AnnonceResource;

class AnnonceController extends Controller
{
    /**
     * liste toutes les annonces
     */
    public function browse()
    {
        // récupération de toutes les annonces en BDD, avec un tri et pagination
        // du paquet Kyslik/column-sortable
//        $annonces = Annonce::sortable('id')->paginate(15);

        $annonces = Annonce::all()->sortByDesc('id');
//        return response()->json($annonces);
        return new AnnonceResource($annonces);
    }

    /**
     * affiche les détails d'une annonce
     */
    public function show($id)
    {
        $annonce = Annonce::find($id);
        return new AnnonceResource($annonce);
    }

    /**
     * ajout de l'annonce en BDD
     * @param Request $request
     */
    public function store(Request $request)
    {
        // validation des données
        $validated = $request->validate([
            'ref_annonce' => 'required',
            'prix_annonce' => 'required',
            'surface_habitable' => 'required',
            'nombre_de_piece' => 'required',
        ]);

        // création de l'annonce en bdd si les données précédentes sont validées
        $annonce = new Annonce();
        $annonce->ref_annonce = $request->input('ref_annonce');
        $annonce->prix_annonce = $request->input('prix_annonce');
        $annonce->surface_habitable = $request->input('surface_habitable');
        $annonce->nombre_de_piece = $request->input('nombre_de_piece');

        $annonce->save();

//        return response()->json(['message'=> 'annonce ajoutée']);
        return response()->json($annonce);
//        return new AnnonceResource($annonce);
    }

    /**
     * modification d'une annonce existante
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        // validation des données
        $validated = $request->validate([
            'ref_annonce' => 'required',
            'prix_annonce' => 'required',
            'surface_habitable' => 'required',
            'nombre_de_piece' => 'required',
        ]);

        // mise à jour de l'annonce en bdd si les données précédentes sont validées
        $annonce = Annonce::findOrFail($id);

        $annonce->ref_annonce = $request->input('ref_annonce');
        $annonce->prix_annonce = $request->input('prix_annonce');
        $annonce->surface_habitable = $request->input('surface_habitable');
        $annonce->nombre_de_piece = $request->input('nombre_de_piece');

        $annonce->save();

//        return new AnnonceResource($annonce);
        return response()->json($annonce);
    }

    /**
     * Suppression d'une annonce
     * @param $id
     */
    public function delete($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return response()->json(['message' => 'supprime']);


//        return new AnnonceResource($annonce);

    }
}
