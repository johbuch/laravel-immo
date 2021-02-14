<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /**
     * liste toutes les annonces
     */
    public function browse()
    {
        // récupération de toutes les annonces en BDD, avec un tri et pagination
        // du paquet Kyslik/column-sortable
        $annonces = Annonce::sortable('id')->paginate(15);

        return view('admin.annonce.browse', compact('annonces'));
    }

    /**
     * affiche le formulaire d'ajout
     */
    public function add()
    {
        return view('admin.annonce.add');
    }

    /**
     * ajout de l'annonce en BDD
     * @param Request $request
     */
    public function store(Request $request)
    {
        // dd($request->input('ref_annonce'));

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

        // redirection
        return redirect()->route('admin_annonces_browse')->with('success', 'L\'annonce a bien été ajoutée en base de données');
    }

    /**
     * affichage du formulaire de modification d'une annonce
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $annonce = Annonce::find($id);

        return view('admin.annonce.edit', compact('annonce'));
    }

    /**
     * modification d'une annonce existante
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
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

        $annonce = Annonce::find($id);

        $annonce->ref_annonce = $request->input('ref_annonce');
        $annonce->prix_annonce = $request->input('prix_annonce');
        $annonce->surface_habitable = $request->input('surface_habitable');
        $annonce->nombre_de_piece = $request->input('nombre_de_piece');

        $annonce->save();

        // redirection
        return redirect()->route('admin_annonces_browse')->with('success', 'L\'annonce a bien été modifiée en base de données');
    }

    /**
     * Suppression d'une annonce
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
//        Annonce::destroy($id);

        $annonce = Annonce::findOrFail($id);
//        dd($annonce);
        $annonce->delete();

        return redirect()->route('admin_annonces_browse')->with('success', 'L\'annonce a bien été supprimée de la base de données');
    }
}
