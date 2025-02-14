<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    // GET /contracts - affiche tout
    public function ContractsByUser(Request $request)
    {
        $contracts = $request->user()->contracts;
        $boxes = $request->user()->boxes;
        $tenants = $request->user()->tenants;

        return view('', [
            'contracts' => $contracts,
            'boxes' => $boxes,
            'tenants' => $tenants,
        ]);
    }

    // GET /contracts/{id} - affiche un élément
    public function ContractByID(Request $request, $id)
    {
        $contract = Contract::find($id);
        $box = $contract->box;
        $tenant = $contract->tenant;

        return view('', [
            'contract' => $contract,
            'box' => $box,
            'tenant' => $tenant,
            ]);
    }

    // GET /contracts/create - affiche le formulaire de création
    public function ContractCreate(Request $request)
    {
        return view('');
    }

    // POST /contracts - enregistre un élément
    public function ContractStore(Request $request)
    {
        $request->validate([
            'id_box' => 'required',
            'id_tenant' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'monthly_price' => 'required',
        ]);

        $user = $request->user();

        $contract = new Contract();
        $contract->id_user = $user->id;
        $contract->id_box = $request->id_box;
        $contract->id_tenant = $request->id_tenant;
        $contract->date_start = $request->date_start;
        $contract->date_end = $request->date_end;
        $contract->monthly_price = $request->monthly_price;

        $contract->save();

        return redirect('');
    }

    // GET /contracts/{id}/edit - affiche le formulaire d'édition
    public function ContractEdit(Request $request, $id)
    {
        $contract = Contract::find($id);

        return view('', [
            'contract' => $contract,
        ]);
    }

    // PUT /contracts/{id}/update - met à jour un élément
    public function ContractUpdate(Request $request, $id)
    {
        $request->validate([
            'id_box' => 'required',
            'id_tenant' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'monthly_price' => 'required',
        ]);
        $user = $request->user();

        $contract = Contract::find($id);
        $contract->id_user = $user->id ? $user->id : $contract->id_user;
        $contract->id_box = $request->id_box ? $request->id_box : $contract->id_box;
        $contract->id_tenant = $request->id_tenant ? $request->id_tenant : $contract->id_tenant;
        $contract->date_start = $request->date_start ? $request->date_start : $contract->date_start;
        $contract->date_end = $request->date_end ? $request->date_end : $contract->date_end;
        $contract->monthly_price = $request->monthly_price ? $request->monthly_price : $contract->monthly_price;

        $contract->save();

        return redirect('');
    }

    // DELETE /contracts - supprime un élément
    public function ContractDestroy(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $contract = Contract::find($id);
        $contract->delete();

        return redirect('');
    }
}
