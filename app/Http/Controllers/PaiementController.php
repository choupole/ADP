<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaiementRequest;
use App\Models\Paiement;
use App\Models\Parcelle;
use App\Models\Proprietaire;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::all();
        $proprietaires = Proprietaire::all();

        return view('pages.paiements.index', compact('paiements', 'proprietaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proprietaires = Proprietaire::all();
        $parcelles = Parcelle::all();

        return view('pages.paiements.create', compact('proprietaires', 'parcelles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proprietaire_id' => 'required',
            'parcelle_id' => 'required',
            'montant' => 'required',
            'datePaie' => 'required|date',
        ]);

        $paiement = new Paiement();
        $paiement->proprietaire_id = $request->input('proprietaire_id');
        $paiement->parcelle_id = $request->input('parcelle_id');
        $paiement->montant = $request->input('montant');
        $paiement->datePaie = $request->input('datePaie');
        $paiement->user_id = $request->input('user_id');
        $paiement->save();

        return redirect()->route('paiements.index')->with('success', 'Le paiement a été ajouté avec succès.');
    }

/**
 * Display the specified resource.
 */
/**
 * Display the specified resource.
 */
public function show($id)
{
    $paiement = Paiement::findOrFail($id);

    return view('pages.paiements.show', compact('paiement'));
}

public function print($id)
{
    $paiement = Paiement::findOrFail($id);

    // Créez une instance de Dompdf avec les options par défaut
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);

    // Générez le contenu de la facture dans une vue
    $html = view('pages.paiements.print', compact('paiement'))->render();

    // Chargez le contenu HTML dans Dompdf
    $dompdf->loadHtml($html);

    // Rendez le contenu de la facture
    $dompdf->render();

    // Générez le PDF et renvoyez-le en réponse
    return $dompdf->stream('facture.pdf');
}

/**
 * Show the form for editing the specified resource.
 */
/**
 * Show the form for editing the specified resource.
 */
public function edit(Paiement $paiement)
{
    $proprietaires = Proprietaire::all();

    return view('paiements.edit', compact('paiement', 'proprietaires'));
}

/**
 * Get the validation rules that apply to the request.
 */
public function rules()
{
    return [
        'proprietaire_id' => 'required',
        'montant' => 'required',
        'datePaie' => 'required|date',
    ];
}

/**
 * Update the specified resource in storage.
 */
public function update(UpdatePaiementRequest $request, Paiement $paiement)
{
    $request->validated();

    $paiement->montant = $request->input('montant');
    $paiement->datePaie = $request->input('datePaie');
    $paiement->user_id = $request->input('user_id');
    $paiement->save();

    return redirect()->route('paiements.index')->with('success', 'Le paiement a été modifié avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return redirect()->route('paiements.index')
                        ->with('success', 'le paiement est supprimé avec succès');
    }
}
