<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFonctionRequest;
use App\Models\Fonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FonctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fonctions = Fonction::all();

        return view('pages.fonctions.index', compact('fonctions'));
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
        $fonction = Fonction::where('name', $request->name)->withTrashed()->first();

        if ($fonction) {
            $fonction->restore();
        } else {
            $request->validate([
                'name' => 'required',
            ]);
            Fonction::create($request->all());
        }

        return redirect()->route('fonctions.index')
            ->with('success', 'fonction créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fonction = Fonction::where('id', $id)->firstOrFail();
        $agents = $fonction->users()->get();
        $policies = DB::select('select * from fonction_police where fonction_id = ?', [$id]);
        $actions = ['create', 'read', 'update', 'delete'];
        $modelFiles = File::files(app_path('Models'));
        $models = [];
        foreach ($modelFiles as $file) {
            $models[] = pathinfo($file)['filename'];
        }

        return view('pages.fonctions.show', [
            'models' => $models,
            'actions' => $actions,
            'fonction' => $fonction,
            'agents' => $agents,
    ], )->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fonction $fonction)
    {
        // exit();
        $actions = ['create', 'read', 'update', 'delete'];
        $modelFiles = File::files(app_path('Models'));
        $models = [];
        foreach ($modelFiles as $file) {
            $models[] = pathinfo($file)['filename'];
        }

        return view('pages.fonctions.edit', [
            'models' => $models,
            'actions' => $actions,
    ], compact('fonction'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function modify(Request $request, $fonctionId)
    {
        DB::table('fonction_police')->where('fonction_id', '=', $fonctionId)->delete();
        $form = $request->form;
        $newTable = [];

        if ($form != null) {
            foreach ($form as $key => $value) {
                $table = explode('_', $key);
                $newTable[0] = $table[0];
                $newTable[1] = $table[1];
                DB::insert('insert into fonction_police(fonction_id, model, action) values(?, ?, ?)', [
                    $request->role_id, $newTable[0], $newTable[1],
                ]);
            }
        } else {
            return redirect()->route('fonctions.show', $request->fonction_id)->with('error', 'Veillez cochet au moins une case ');
        }

        return redirect()->route('fonctions.show', ['fonction' => $fonctionId]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFonctionRequest $request, Fonction $fonction)
    {
        $fonction->update($request->all());

        return redirect()->route('fonctions.index')
                         ->with('success', 'Fonction modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fonction $fonction)
    {
        if ($fonction->users()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Cette fonction ne peut pas être supprimée car elle est associée à des utilisateurs']);
        } else {
            $fonction->delete();

            return redirect()->route('fonctions.index')
                            ->with('success', 'la fonction est supprimée avec succès');
        }
    }
}
