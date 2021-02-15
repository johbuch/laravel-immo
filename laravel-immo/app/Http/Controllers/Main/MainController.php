<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function browse() {
        // récupération de toutes les annonces triées par l'ID
        $annonces = Annonce::all()->sortByDesc('id');

        return view('main.browse', compact('annonces'));
    }
}
