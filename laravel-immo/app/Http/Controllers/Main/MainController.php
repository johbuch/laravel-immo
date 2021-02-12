<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function browse() {
        $annonces = Annonce::all();
        return view('main.browse', compact('annonces'));
    }
}
