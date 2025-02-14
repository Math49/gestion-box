<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\Contract;

class TenantController extends Controller
{
    // GET /tenants - affiche tout
    public function TenantsByUser(Request $request)
    {
        $tenants = $request->user()->tenants;
        $contracts = $request->user()->contracts;
        $boxes = $request->user()->boxes;

        return view('dashboard', [
            'tenants' => $tenants,
            'contracts' => $contracts,
            'boxes' => $boxes,
        ]);
    }
    // GET /tenants/{id} - affiche un élément
    public function TenantByID(Request $request, $id)
    {
        $tenant = Tenant::find($id);
        $contract = Contract::where('id_tenant', $id)->first();
        $box = $contract->box;

        return view('', [
            'tenant' => $tenant,
            'contract' => $contract,
            'box' => $box,
        ]);
    }

    // GET /tenants/create - affiche le formulaire de création
    public function TenantCreate(Request $request)
    {
        return view('');
    }

    // POST /tenants - enregistre un élément
    public function TenantStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = $request->user();

        $tenant = new Tenant();
        $tenant->name = $request->name;
        $tenant->firstname = $request->firstname;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->address = $request->address;
        $tenant->id_data_owner = $user->id;
        $tenant->save();

        return redirect('');
    }

    // GET /tenants/{id}/edit - affiche le formulaire d'édition
    public function TenantEdit(Request $request, $id)
    {
        $tenant = Tenant::find($id);

        return view('', [
            'tenant' => $tenant,
        ]);
    }

    // PUT /tenants/{id}/update - met à jour un élément
    public function TenantUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = $request->user();

        $tenant = Tenant::find($id);

        $tenant->name = $request->name ? $request->name : $tenant->name;
        $tenant->firstname = $request->firstname ? $request->firstname : $tenant->firstname;
        $tenant->email = $request->email ? $request->email : $tenant->email;
        $tenant->phone = $request->phone ? $request->phone : $tenant->phone;
        $tenant->address = $request->address ? $request->address : $tenant->address;
        $tenant->id_data_owner = $user->id;
        $tenant->save();

        return redirect('');
    }

    // DELETE /tenants - supprime un élément
    public function TenantDestroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $tenant = Tenant::find($request->id);
        $tenant->delete();

        return redirect('');
    }
}
