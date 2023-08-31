<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proprietaires = Proprietaire::all();

        return view('pages.proprietaires.index', compact('proprietaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nationality = Nationality::where('name', 'Congolaise')->first();
        $nationalities = Nationality::all();

        return view('pages.proprietaires.create', compact('nationalities', 'nationality'));
    }

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $proprietaire = new Proprietaire();
    $proprietaire->nom = $request->input('nom');
    $proprietaire->postnom = $request->input('postnom');
    $proprietaire->prenom = $request->input('prenom');
    $proprietaire->sexe = $request->input('sexe');
    $proprietaire->numeroPar = $request->input('numeroPar');
    $proprietaire->avenue = $request->input('avenue');
    $proprietaire->quartier = $request->input('quartier');
    $proprietaire->commune = $request->input('commune');

    // Générer un matricule aléatoire unique
    do {
        $matricule = rand(100000, 999999);
    } while (Proprietaire::where('id', $matricule)->exists());

    $proprietaire->id = $matricule; // assigner le matricule aléatoire généré au champ "id"
    $proprietaire->nationalities()->sync($request->nationalities);
    $proprietaire->save();

    // Attacher plusieurs nationalités au propriétaire
    $proprietaire->nationalities()->attach($request->input('nationalities'));

    return redirect('proprietaires')->with('status', 'Proprietaire crée avec succés');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proprietaire = Proprietaire::findOrFail($id);

        return view('pages.proprietaires.show', compact('proprietaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proprietaire $proprietaire)
    {
        $nationalities = Nationality::all();

        return view('pages.proprietaires.edit', compact('proprietaire', 'nationalities'));
    }

    public function update(Request $request, Proprietaire $proprietaire)
    {
        $proprietaire->nom = $request->input('nom');
        $proprietaire->postnom = $request->input('postnom');
        $proprietaire->prenom = $request->input('prenom');
        $proprietaire->sexe = $request->input('sexe');
        $proprietaire->numeroPar = $request->input('numeroPar');
        $proprietaire->avenue = $request->input('avenue');
        $proprietaire->quartier = $request->input('quartier');
        $proprietaire->commune = $request->input('commune');

        $proprietaire->nationalities()->sync($request->nationalities);

        $proprietaire->save();

        return redirect()->route('proprietaires.index')
                         ->with('success', 'Propriétaire modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proprietaire $proprietaire)
    {
        $proprietaire->delete();

        return redirect()->route('proprietaires.index')
                        ->with('success', 'la proprietaire est supprimé avec succès');
    }
}
