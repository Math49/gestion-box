<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocataireController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\ContratController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [BoxController::class, 'BoxsByUser'])->name('dashboard');
    Route::get('/box/add', [BoxController::class, 'createBox'])->name('box.add');
    Route::post('/box/add', [BoxController::class, 'storeBox'])->name('box.create');
    Route::get('/box/{id}', [BoxController::class, 'viewBox'])->name('box.view');
    Route::get('/box/{id}/edit', [BoxController::class, 'updateBox'])->name('box.edit');
    Route::put('/box/{id}/edit', [BoxController::class, 'editBox'])->name('box.update');

    Route::get('/locataire', [LocataireController::class, 'LocatairesByUser'])->name('locataire');
    Route::put('/locataire/{id}/update-box', [BoxController::class, 'updateBoxLocataire'])->name('locataire.updateBox');
    Route::get('/locataire/create', [LocataireController::class, 'create'])->name('locataire.create');
    Route::post('/locataire/store', [LocataireController::class, 'createLocataire'])->name('locataire.store');
    Route::get('/locataire/{id}', [LocataireController::class, 'viewLocataire'])->name('locataire.view');
    Route::get('/locataire/{id}/edit', [LocataireController::class, 'editLocataire'])->name('locataire.edit');
    Route::put('/locataire/{id}/edit', [LocataireController::class, 'updateLocataire'])->name('locataire.update');

    Route::get('/contrats', [ContratController::class, 'index'])->name('contrat.index');
    Route::get('/contrats/types', [ContratController::class, 'types'])->name('contrat.types');
    Route::get('/contrats/edit/{type}', [ContratController::class, 'edit'])->name('contrat.edit');
    Route::put('/contrats/update/{type}', [ContratController::class, 'update'])->name('contrat.update');
    Route::get('/contrats/download/{id}', [ContratController::class, 'download'])->name('contrat.download');
    Route::get('/contrats/create', [ContratController::class, 'create'])->name('contrat.create');
    Route::post('/contrats/store', [ContratController::class, 'store'])->name('contrat.store');


});

require __DIR__.'/auth.php';
