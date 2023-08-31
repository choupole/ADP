<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\Paiement;
use App\Models\Parcelle;
use App\Models\Proprietaire;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $proprietaires_count = Proprietaire::count();

        $paiements_count = Paiement::count();

        $parcelles_count = Parcelle::count();

        $attestations_count = Attestation::count();

        return view('home', compact('proprietaires_count', 'paiements_count', 'parcelles_count', 'attestations_count'));
    }
}
