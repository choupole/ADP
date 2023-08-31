<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = User::all();

        return view('pages.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fonctions = Fonction::all();

        return view('pages.agents.create', compact('fonctions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Récupérer les données du formulaire
        $matricule = $request->input('matricule');
        $name = $request->input('name');
        $postnom = $request->input('postnom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $password = $request->input('password');
        $fonctions = $request->input('fonctions');
        $image = $request->file('image');

        // Valider les données si nécessaire
        // ...
        $filename = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move(public_path('assets/uploads/agents/'), $filename);
        }

        // Enregistrer l'agent dans la base de données
        $agent = new User();
        $agent->matricule = $matricule;
        $agent->name = $name;
        $agent->postnom = $postnom;
        $agent->prenom = $prenom;
        $agent->email = $email;
        $agent->password = bcrypt($password);
        $agent->image = $filename;
        $agent->save();

        // Enregistrer les fonctions de l'agent
        $agent->fonctions()->sync($fonctions);

        // Enregistrer les numéros de téléphone de l'agent
        $phoneNumbers = $request->input('phone_numbers');

        foreach ($phoneNumbers as $phoneNumber) {
            $agent->phoneNumbers()->create(['phone_number' => $phoneNumber]);
        }

        return redirect()->route('agents.index')
                        ->with('success', 'l\'agent est crée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agent = User::findOrFail($id);

        return view('agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $agent, Fonction $fonction)
    {
        /*  if(Gate::denies('edit-users')){
             return redirect()->route('users.index');
         } */
        $fonctions = Fonction::all();

        return view('agents.edit', compact(['agent', 'fonctions']));
    }

    public function update(Request $request, $id)
    {
        // Récupérer l'agent à mettre à jour
        $agent = User::findOrFail($id);

        // Récupérer les données du formulaire
        $matricule = $request->input('matricule');
        $name = $request->input('name');
        $postnom = $request->input('postnom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $password = $request->input('password');
        $fonctions = $request->input('fonctions');
        $image = $request->file('image');

        // Valider les données si nécessaire
        // ...
        $filename = $agent->image; // Conserver l'ancien nom de fichier par défaut

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move(public_path('assets/uploads/agents/'), $filename);

            // Supprimer l'ancien fichier d'image s'il existe
            if ($agent->image) {
                $oldFilePath = public_path('assets/uploads/agents/').$agent->image;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        // Mettre à jour les informations de l'agent dans la base de données
        $agent->matricule = $matricule;
        $agent->name = $name;
        $agent->postnom = $postnom;
        $agent->prenom = $prenom;
        $agent->email = $email;

        // Mettre à jour le mot de passe si une nouvelle valeur est fournie
        if ($password) {
            $agent->password = bcrypt($password);
        }

        $agent->image = $filename;
        $agent->save();

        // Mettre à jour les fonctions de l'agent
        $agent->fonctions()->sync($fonctions);

        // Mettre à jour les numéros de téléphone de l'agent
        $phoneNumbers = $request->input('phone_numbers');

        // Supprimer tous les numéros de téléphone existants de l'agent
        $agent->phoneNumbers()->delete();

        // Ajouter les nouveaux numéros de téléphone à l'agent
        foreach ($phoneNumbers as $phoneNumber) {
            $agent->phoneNumbers()->create(['phone_number' => $phoneNumber]);
        }

        return redirect()->route('agents.index')->with('success', 'Les informations de l\'agent ont été mises à jour avec succès');
    }
    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        $User->delete();

        return redirect()->route('users.index')
                        ->with('success', 'l\'agent est supprimé avec succès');
    }
}
