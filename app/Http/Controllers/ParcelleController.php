<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Parcelle;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class ParcelleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcelles = Parcelle::with('proprietaire', 'category')->get();

        return view('pages.parcelles.index', compact('parcelles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proprietaires = Proprietaire::all();
        $categories = Category::all();

        return view('pages.parcelles.create', compact('proprietaires', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $parcelle = Parcelle::create($request->all());

        return redirect()->route('parcelles.index')
            ->with('success', 'Parcelle créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(Parcelle $parcelle)
    {
        return view('pages.parcelles.show', compact('parcelle'));
    }

    public function update(Request $request, Parcelle $parcelle)
    {
        $parcelle->update($request->all());

        return redirect()->route('parcelles.index')
            ->with('success', 'Parcelle mise à jour avec succès.');
    }

/**
 * Show the form for editing the specified resource.
 */
/**
 * Show the form for editing the specified resource.
 */
public function edit(Parcelle $parcelle)
{
    $proprietaires = Proprietaire::all();
    $categories = Category::all();

    return view('pages.parcelles.edit', compact('parcelle', 'proprietaires', 'categories'));
}

    /**
     * Get the validation rules that apply to the request.
     */

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcelle $parcelle)
    {
        $parcelle->delete();

        return redirect()->route('parcelles.index')
                        ->with('success', 'la parcelle est supprimé avec succès');
    }
}
