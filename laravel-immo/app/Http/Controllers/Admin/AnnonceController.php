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

        // récupération de toutes les annonces en BDD
        $annonces = Annonce::all();

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
     */
    public function edit(Annonce $annonce, $id)
    {
        $annonce = Annonce::find($id);

        return view('admin.annonce.edit', compact('annonce'));
    }

    /**
     * modification d'une annonce existante
     */
    public function update(Annonce $annonce, Request $request)
    {
        // validation des données
        $validated = $request->validate([
            'ref_annonce' => 'required',
            'prix_annonce' => 'required',
            'surface_habitable' => 'required',
            'nombre_de_piece' => 'required',
        ]);

        $annonce->ref_annonce = $request->input('ref_annonce');
        $annonce->prix_annonce = $request->input('prix_annonce');
        $annonce->surface_habitable = $request->input('surface_habitable');
        $annonce->nombre_de_piece = $request->input('nombre_de_piece');

        $annonce->save();

        // redirection
        return redirect()->route('admin_annonces_browse')->with('success', 'L\'annonce a bien été ajoutée en base de données');
    }
}
