<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ParcelleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProprietaireController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('proprietaires', ProprietaireController::class)->middleware('checkaccess:Proprietaire');
    Route::resource('nationalities', NationalityController::class)->middleware('checkaccess:Nationality');
    Route::resource('categories', CategoryController::class)->middleware('checkaccess:Category');
    Route::resource('parcelles', ParcelleController::class)->middleware('checkaccess:Parcelle');
    Route::resource('paiements', PaiementController::class)->middleware('checkaccess:Paiement');
    Route::resource('attestations', AttestationController::class)->middleware('checkaccess:Attestation');
    Route::resource('fonctions', FonctionController::class)->middleware('checkaccess:Fonction');
    Route::resource('agents', AgentController::class)->middleware('checkaccess:User');
    Route::get('/paiements/{paiement}/print', [App\Http\Controllers\PaiementController::class, 'print'])->name('paiements.print');
    Route::post('fonctions/modify/{fonctionId}', [App\Http\Controllers\FonctionController::class, 'modify'])->name('fonctions.modify')->middleware('checkaccess:Nationality');
});

require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
