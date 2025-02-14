<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractModel;
use App\Models\Box;
use App\Models\Tenant;
use App\Models\Bill;

class ContractController extends Controller
{
    // ✅ GET /contracts - Liste tous les contrats
    public function ContractsByUser(Request $request)
    {
        $contracts = $request->user()->contracts()->with(['box', 'tenant'])->get();
        $boxes = $request->user()->boxes()->get();
        $tenants = $request->user()->tenants()->get();

        return view('contracts.index', compact('contracts', 'boxes', 'tenants'));
    }

    // ✅ GET /contracts/{id} - Affiche un contrat et ses factures
    public function ContractByID(Request $request, $id)
    {
        $contract = Contract::with(['box', 'tenant', 'bills'])->findOrFail($id);

        return view('contracts.show', compact('contract'));
    }

    // ✅ GET /contracts/create - Affiche le formulaire de création
    public function ContractCreate(Request $request)
    {
        $contract_models = $request->user()->contractsModels()->get();
        $boxes = $request->user()->boxes()->get();
        $tenants = $request->user()->tenants()->get();

        return view('contracts.create', compact('contract_models', 'boxes', 'tenants'));
    }

    // ✅ POST /contracts - Enregistre un nouveau contrat et génère les factures
    public function ContractStore(Request $request)
    {
        $request->validate([
            'id_box' => 'required',
            'id_tenant' => 'required',
            'id_contract_model' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'monthly_price' => 'required',
        ]);

        $user = $request->user();
        $contractModel = ContractModel::findOrFail($request->input('id_contract_model'));
        $box = Box::findOrFail($request->input('id_box'));
        $tenant = Tenant::findOrFail($request->input('id_tenant'));


        // 🔄 Remplacement des placeholders dans le modèle de contrat
        $contractContent = str_replace(
            ['{NOM_LOCATAIRE}', '{PRENOM_LOCATAIRE}', '{ADRESSE_BOX}', '{DATE_DEBUT}', '{DATE_FIN}'],
            [$tenant->name, $tenant->firstname, $box->address, $request->date_start, $request->date_end],
            $contractModel->content
        );

        // 📝 Création du contrat
        $contract = Contract::create([
            'id_user' => $user->id_user,
            'id_box' => $request->input('id_box'),
            'id_tenant' => $request->input('id_tenant'),
            'content' => $contractContent,
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'monthly_price' => $request->input('monthly_price'),
        ]);


        // 📆 Génération des factures mensuelles
        $start = now()->parse($request->input('date_start'));
        $end = now()->parse($request->input('date_end'));
        $periods = $start->diffInMonths($end);

        if ($periods > 0) {
            for ($i = 1; $i <= $periods; $i++) {
                Bill::create([
                    'payement_price' => $request->input('monthly_price'),
                    'payement_date' => $start->addMonths($i)->format('Y-m-d'),
                    'period_number' => $i,
                    'id_contract' => $contract->id_contract,
                ]);
            }
        }

        return redirect()->route('contract.index')->with('success', 'Contrat et factures créés avec succès.');
    }

    // ✅ GET /contracts/{id}/edit - Affiche le formulaire d'édition
    public function ContractEdit(Request $request, $id)
    {
        $contract = Contract::with(['box', 'tenant'])->findOrFail($id);
        $tenants = $request->user()->tenants()->get();

        return view('contracts.edit', compact('contract', 'tenants'));
    }

    // ✅ PUT /contracts/{id}/update - Met à jour un contrat
    public function ContractUpdate(Request $request, $id)
    {
        $request->validate([
            'id_box' => 'required|exists:boxes,id_box',
            'id_tenant' => 'required|exists:tenants,id_tenant',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after:date_start',
            'monthly_price' => 'required|numeric|min:0',
        ]);

        $contract = Contract::findOrFail($id);

        // 🔄 Mise à jour des informations
        $contract->update([
            'id_box' => $request->id_box,
            'id_tenant' => $request->id_tenant,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'monthly_price' => $request->monthly_price,
        ]);

        return redirect()->route('contract.index')->with('success', 'Contrat mis à jour.');
    }

    // ✅ DELETE /contracts/{id} - Supprime un contrat et ses factures
    public function ContractDestroy($id)
    {
        $contract = Contract::with('bills')->findOrFail($id);

        // ❌ Suppression des factures associées
        $contract->bills()->delete();
        $contract->delete();

        return redirect()->route('contract.index')->with('success', 'Contrat supprimé.');
    }
}
