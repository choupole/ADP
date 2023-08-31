<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\Paiement;
use App\Models\Parcelle;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les attestations de la base de données
        $attestations = Attestation::all();

        // Passer les attestations à la vue pour les afficher
        return view('pages.attestations.index', compact('attestations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allPaiement = Paiement::all();

        return view('pages.attestations.create', compact('allPaiement'));
    }

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $attestation = new Attestation();
    $attestation->user_id = $request->input('user_id');
    $attestation->parcelle_id = $request->input('parcelle_id');
    $attestation->paiement_id = $request->input('paiement_id');
    $attestation->dateED = $request->input('dateED');
    $attestation->dateREM = $request->input('dateREM');
    $attestation->save();

    // Rediriger vers une page de succès ou afficher un message de succès

    return redirect()->route('attestations.index')
    ->with('success', 'l\'attestation est crée avec succès');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attestation = Attestation::findOrFail($id);

        return view('pages.attestations.print', ['attestation' => $attestation]);
    }

        // Generate PDF
    public function createPDF($id)
    {
        // Vérifier que l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Récupérer toutes les attestations de la base de données
        $attestation = Attestation::findOrFail($id);
        // Passer les attestations à la vue
        return view('attestations.print', compact('attestation'));

        // Générer le fichier PDF à partir de la vue
        $pdf = PDF::loadView('attestations.print', compact('attestation'));

        // Afficher le fichier PDF dans le navigateur de l'utilisateur
        return $pdf->stream();

        // Ou télécharger le fichier PDF automatiquement avec un nom prédéfini
        // return $pdf->download('pdf_file.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attestation $attestation)
    {
        $parcelles = Parcelle::all();
        $paiements = Paiement::all();

        return view('attestations.edit', compact('attestation', 'parcelles', 'paiements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attestation $attestation)
    {
        // Valider les données soumises par le formulaire
        $validatedData = $request->validate([
            'parcelle_id' => 'required|exists:parcelles,id',
            'paiement_id' => 'required|exists:paiements,id',
            'dateED' => 'required|date',
            'dateREM' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        // Mettre à jour l'attestation avec les données soumises
        $attestation->parcelle_id = $validatedData['parcelle_id'];
        $attestation->paiement_id = $validatedData['paiement_id'];
        $attestation->dateED = $validatedData['dateED'];
        $attestation->dateREM = $validatedData['dateREM'];
        $attestation->user_id = $validatedData['user_id'];

        // Enregistrer les modifications dans la base de données
        $attestation->save();

        // Rediriger vers la vue de détails de l'attestation mise à jour
        return redirect()->route('attestations.show', ['attestation' => $attestation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attestation $attestation)
    {
        $attestation->delete();

        return redirect()->route('attestations.index')
                        ->with('success', 'l\'attestation est supprimé avec succès');
    }
}
