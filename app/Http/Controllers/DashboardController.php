<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\Paiement;
use App\Models\Parcelle;
use App\Models\Proprietaire;

class DashboardController extends Controller
{
    public function index()
    {
        // Logique métier pour le tableau de bord
        $attestationsCount = Attestation::get()->count();
        $paiementsCount = Paiement::get()->count();
        $proprietairesCount = Proprietaire::get()->count();
        $parcellesCount = Parcelle::get()->count();

        // Retourne la vue du tableau de bord avec les nombres d'enregistrements
        return view('pages.agents.dashboard', compact('attestationsCount', 'paiementsCount', 'proprietairesCount', 'parcellesCount'));
    }
}
