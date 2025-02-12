<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocataireController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\UserController;
use App\Models\Box;

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
});

require __DIR__.'/auth.php';
