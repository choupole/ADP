<?php

use App\Models\Fonction;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Création du rôle 'admin'
        DB::table('fonctions')->insert([
            'name' => 'admin',
        ]);

        // Création de l'utilisateur admin
        $admin = DB::table('users')->insertGetId([
            'name' => 'rootadmin',
            'postnom' => 'rootadmin',
            'prenom' => 'rootadmin',
            'email' => 'admin@example.com',
            'matricule' => 'rootadmin',
            'password' => Hash::make('choupole'),
        ]);

        // Ajout du rôle 'admin' à l'utilisateur admin
        $fonction = Fonction::where('name', 'admin')->first();
        if ($fonction) {
            $user = User::find($admin);
            $user->fonctions()->attach($fonction);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Suppression de l'utilisateur admin
        DB::table('users')->where('email', 'admin@example.com')->delete();

        // Suppression du rôle 'admin'
        DB::table('fonctions')->where('name', 'admin')->delete();
    }
};
