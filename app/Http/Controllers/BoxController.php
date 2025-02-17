<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Contract;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    // GET /boxes - affiche tout
    public function BoxesByUser(Request $request)
    {
        $boxes = $request->user()->boxes;
        $contracts = $request->user()->contracts;
        $tenants = $request->user()->tenants;

        return view('boxes/index', [
            'boxes' => $boxes,
            'contracts' => $contracts,
            'tenants' => $tenants,
        ]);
    }

    // GET /boxes/{id} - affiche un élément
    public function BoxByID(Request $request, $id)
    {
        $boxe = Box::find($id);
        $contract = Contract::where('id_box', $id)
        ->where('date_end', '>=', now())
        ->first();

        $tenant = $contract ? $contract->tenant : null;

        return view('boxes/show', [
            'box' => $boxe,
            'contract' => $contract,
            'tenant' => $tenant,
        ]);
    }

    // GET /boxes/create - affiche le formulaire de création
    public function BoxCreate(Request $request)
    {
        return view('boxes/create');
    }

    // POST /boxes - enregistre un élément
    public function BoxStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $user = $request->user();

        $box = new Box();
        $box->name = $request->name;
        $box->address = $request->address;
        $box->description = $request->description;
        $box->price = $request->price;
        $box->id_owner = $user->id_user;
        $box->save();

        return redirect()->route('box.index');
    }

    // GET /boxes/{id}/edit - affiche le formulaire d'édition
    public function BoxEdit(Request $request, $id)
    {
        $box = Box::find($id);

        return view('boxes/edit', [
            'box' => $box,
        ]);
    }

    // PUT /boxes/{id}/update - met à jour un élément
    public function BoxUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $user = $request->user();

        $box = Box::find($id);

        $box->name = $request->name ? $request->name : $box->name;
        $box->address = $request->address ? $request->address : $box->address;
        $box->description = $request->description ? $request->description : $box->description;
        $box->price = $request->price ? $request->price : $box->price;
        $box->id_owner = $user->id_user;
        $box->save();

        return redirect()->route('box.index');
    }

    // DELETE /boxes - supprime un élément
    public function BoxDestroy(Request $request)
    {
        $request->validate([
            'id_box' => 'required',
        ]);

        $box = Box::find($request->id_box);
        
        $box->delete();

        return redirect()->route('box.index');
    }
}
