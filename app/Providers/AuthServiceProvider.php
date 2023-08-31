<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Fonction;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // debut de la création de notre Gate
        Gate::define('access', function (User $user2, $model) {
            $user_id = Auth::user()->id;
            // ici on faite un table des differents actions qui feronts office du crud
            $actionMap = [
               'post' => 'create',
               'get' => 'read',
               'put' => 'update',
               'patch' => 'update',
               'delete' => 'delete',
            ];
            // code a fixé car les nouveau utilisateur qui n'ont pas de rôles
            $fonction = Fonction::firstOrCreate(['name' => 'user']);
            // ici on  récupére l'utilisateur connecter
            $user = auth()->user();
            // ici on vérifie si l'utilisateur possède une fonction
            if ($user->fonctions->isEmpty()) {
                $user2->fonctions()->syncWithoutDetaching($fonction->id);
                $user2->save();
            // Enregistrement des données dans la base de données au cas ou l'utilisateur n'as pas de rôle
            } else {
                $fonction = $user->fonctions->first();
            }
            // ici on fait un parralellisme entre les actions fournir par la methode $server avec notre table
            $action = $_SERVER['REQUEST_METHOD'];
            $action = strtolower($action);
            if (isset($actionMap[$action])) {
                $action = $actionMap[$action];
            }
            if ($fonction->name == 'admin') {
                return true;
            }
            // ici on vérifier si l'utilisateur possède plusieurs rôles
            $fonctions = User::find($user_id)->fonctions()->pluck('id')->toArray(); // Récupération des IDs de deux rôles sous forme de tableau
            $check = DB::table('fonction_police')->where('model', $model)
                                              ->where('action', $action)
                                              ->whereIn('fonction_id', $fonctions)
                                              ->select('id')
                                              ->count();
            if ($check > 0) {
                return true; // l'utilisateur a les autorisations nécessaires
            } else {
                return false; // l'utilisateur n'a pas les autorisations nécessaires
            }
        });
    }
}
