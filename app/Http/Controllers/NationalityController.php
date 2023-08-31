<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNationnalityRequest;
use App\Models\Nationality;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nationalities = Nationality::all();

        return view('pages.nationalites.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nationality = Nationality::where('name', $request->name)->withTrashed()->first();

        if ($nationality) {
            $nationality->restore();
        } else {
            $request->validate([
                'name' => 'required',
            ]);
            Nationality::create($request->all());
        }

        return redirect()->route('nationalities.index')
            ->with('success', 'nationalité créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nationality $nationality)
    {
        $proprietaires = Proprietaire::whereHas('nationalities', function ($query) use ($nationality) {
            $query->where('nationalities.id', $nationality->id);
        })->get();

        return view('pages.nationalites.show', compact('nationality', 'proprietaires'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nationality $nationality)
    {
        return view('nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNationnalityRequest $request, Nationality $nationality)
    {
        $nationality->update($request->all());

        return redirect()->route('nationalities.index')
                         ->with('success', 'Nationalité modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nationality $nationality)
    {
        if ($nationality->proprietaires()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Cette nationalité ne peut pas être supprimée car elle est associée à des utilisateurs']);
        } else {
            $nationality->delete();

            return redirect()->route('nationalities.index')->with('success', 'Nationalité supprimée avec succès');
        }
    }
}
