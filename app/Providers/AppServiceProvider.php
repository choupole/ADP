<?php

namespace App\Providers;

use App\Models\Fonction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // création de notre variable access qui sera utilisé dans toutes nos vues
        Blade::if('access', function ($action, $model) {
            // ici on récupere l'utilisateur connection (particulièrement son id)
            $user_id = Auth::user()?->id;
            // ici on chercher l'utilisateur grace à son id qui est stocker dans la variable $user_id
            $user2 = User::find($user_id);
            // code à fixé car on j'arrive pas à données un fonctions à la création d'un user
            $fonction = Fonction::firstOrCreate(['name' => 'user']);
            $user = auth()?->user();
            if ($user->fonctions->isEmpty()) {
                $user2->fonctions()->syncWithoutDetaching($fonction->id);
                $user2->save();
            // Enregistrement des données dans la base de données
            } else {
                $fonction = $user->fonctions->first();
            }
            if ($fonction->name == 'admin') {
                return true;
            }
                    // Récuperation des plusieurs rôles
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
