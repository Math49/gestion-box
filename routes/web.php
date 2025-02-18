<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ContractModelsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Box
Route::prefix('boxes')->middleware(['auth'])->group(function () {
    Route::get('/', [BoxController::class, 'BoxesByUser'])->name('box.index');
    Route::get('/create', [BoxController::class, 'BoxCreate'])->name('box.create');
    Route::post('/', [BoxController::class, 'BoxStore'])->name('box.store');
    Route::get('/{id}', [BoxController::class, 'BoxByID'])->name('box.show');
    Route::get('/{id}/edit', [BoxController::class, 'BoxEdit'])->name('box.edit');
    Route::put('/{id}', [BoxController::class, 'BoxUpdate'])->name('box.update');
    Route::delete('/', [BoxController::class, 'BoxDestroy'])->name('box.destroy');
});

// Contrats
Route::prefix('contracts')->middleware(['auth'])->group(function () {
    Route::get('/', [ContractController::class, 'ContractsByUser'])->name('contract.index');
    Route::get('/create', [ContractController::class, 'ContractCreate'])->name('contract.create');
    Route::post('/', [ContractController::class, 'ContractStore'])->name('contract.store');
    Route::get('/{id}', [ContractController::class, 'ContractByID'])->name('contract.show');
    Route::get('/{id}/edit', [ContractController::class, 'ContractEdit'])->name('contract.edit');
    Route::put('/{id}', [ContractController::class, 'ContractUpdate'])->name('contract.update');
    Route::delete('/', [ContractController::class, 'ContractDestroy'])->name('contract.destroy');
    Route::get('{id}/download-pdf', [ContractController::class, 'DownloadPDF'])->name('contract.downloadpdf');
    
    Route::put('bills/{id}/pay', [BillController::class, 'BillPay'])->name('bill.pay');
    Route::get('bills/{id}/download-pdf', [BillController::class, 'DownloadPDF'])->name('bill.downloadpdf');
});

// Locataires
Route::prefix('tenants')->middleware(['auth'])->group(function () {
    Route::get('/', [TenantController::class, 'TenantsByUser'])->name('tenant.index');
    Route::get('/create', [TenantController::class, 'TenantCreate'])->name('tenant.create');
    Route::post('/', [TenantController::class, 'TenantStore'])->name('tenant.store');
    Route::get('/{id}', [TenantController::class, 'TenantByID'])->name('tenant.show');
    Route::get('/{id}/edit', [TenantController::class, 'TenantEdit'])->name('tenant.edit');
    Route::put('/{id}', [TenantController::class, 'TenantUpdate'])->name('tenant.update');
    Route::delete('/', [TenantController::class, 'TenantDestroy'])->name('tenant.destroy');
});

// Modèles de Contrats
Route::prefix('contract-models')->middleware(['auth'])->group(function () {
    Route::get('/', [ContractModelsController::class, 'ContractModelsByUser'])->name('contractModel.index');
    Route::get('/create', [ContractModelsController::class, 'ContractModelCreate'])->name('contractModel.create');
    Route::post('/', [ContractModelsController::class, 'ContractModelStore'])->name('contractModel.store');
    Route::get('/{id}', [ContractModelsController::class, 'ContractModelByID'])->name('contractModel.show');
    Route::get('/{id}/edit', [ContractModelsController::class, 'ContractModelEdit'])->name('contractModel.edit');
    Route::put('/{id}', [ContractModelsController::class, 'ContractModelUpdate'])->name('contractModel.update');
    Route::delete('/', [ContractModelsController::class, 'ContractModelDestroy'])->name('contractModel.destroy');
});

Route::prefix('')->middleware(['auth'])->group(function () {

    Route::get('/tax', [TaxController::class, 'index'])->name('tax.index');
    Route::post('/tax/calculate', [TaxController::class, 'calculate'])->name('tax.calculate');
    Route::get('/tax/download/{total_income}/{taxable_income}/{regime}', [TaxController::class, 'downloadPDF'])->name('tax.download');
    
    Route::get('/export/payments', [ExportController::class, 'exportPayments'])->name('export.payments');
    Route::get('/export/tenants', [ExportController::class, 'exportTenants'])->name('export.tenants');

});
require __DIR__.'/auth.php';
