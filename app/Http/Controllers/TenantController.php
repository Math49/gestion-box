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

        return view('tenants/index', [
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
        if (!$contract) {
            return view('tenants/show', [
                'tenant' => $tenant,
                'contract' => null,
                'box' => null,
            ]);
        }
        
        $box = $contract->box;

        return view('tenants/show', [
            'tenant' => $tenant,
            'contract' => $contract,
            'box' => $box,
        ]);
    }

    // GET /tenants/create - affiche le formulaire de création
    public function TenantCreate(Request $request)
    {
        return view('tenants/create');
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
        $tenant->data_owner_id = $user->id_user;
        $tenant->save();

        return redirect()->route('tenant.index');
    }

    // GET /tenants/{id}/edit - affiche le formulaire d'édition
    public function TenantEdit(Request $request, $id)
    {
        $tenant = Tenant::find($id);

        return view('tenants/edit', [
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
        $tenant->data_owner_id = $user->id_user;
        $tenant->save();

        return redirect()->route('tenant.index');
    }

    // DELETE /tenants - supprime un élément
    public function TenantDestroy(Request $request)
    {
        $request->validate([
            'id_tenant' => 'required',
        ]);

        $tenant = Tenant::find($request->id_tenant);
        $tenant->delete();

        return redirect()->route('tenant.index');
    }

    public function exportCsv()
{
    $tenants = Tenant::all();

    $fileName = 'locataires_' . now()->format('Y-m-d_H-i-s') . '.csv';
    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Expires" => "0",
    ];

    $callback = function () use ($tenants) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID Locataire', 'Nom', 'Prénom', 'Email', 'Téléphone', 'Adresse']);

        foreach ($tenants as $tenant) {
            fputcsv($handle, [
                $tenant->id_tenant,
                $tenant->name,
                $tenant->firstname,
                $tenant->email,
                $tenant->phone,
                $tenant->address,
            ]);
        }

        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
}

}
