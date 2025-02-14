<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractModel;

class ContractModelsController extends Controller
{
    // GET /contract_models - affiche tout
    public function ContractModelsByUser(Request $request)
    {
        $contract_models = $request->user()->contract_models;

        return view('', [
            'contract_models' => $contract_models,
        ]);
    }

    // GET /contract_models/{id} - affiche un élément
    public function ContractModelByID(Request $request, $id)
    {
        $contract_model = ContractModel::find($id);

        return view('', [
            'contract_model' => $contract_model,
        ]);
    }

    // GET /contract_models/create - affiche le formulaire de création
    public function ContractModelCreate(Request $request)
    {
        return view('');
    }

    // POST /contract_models - enregistre un élément
    public function ContractModelStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $user = $request->user();

        $contract_model = new ContractModel();
        $contract_model->name = $request->name;
        $contract_model->content = $request->content;
        $contract_model->id_owner = $user->id;
        $contract_model->save();

        return redirect('');
    }

    // GET /contract_models/{id}/edit - affiche le formulaire d'édition
    public function ContractModelEdit(Request $request, $id)
    {
        $contract_model = ContractModel::find($id);

        return view('', [
            'contract_model' => $contract_model,
        ]);
    }

    // PUT /contract_models/{id}/update - met à jour un élément
    public function ContractModelUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $user = $request->user();

        $contract_model = ContractModel::find($id);

        $contract_model->name = $request->name ? $request->name : $contract_model->name;
        $contract_model->content = $request->content ? $request->content : $contract_model->content;
        $contract_model->id_owner = $user->id;
        $contract_model->save();

        return redirect('');
    }

    // DELETE /contract_models - supprime un élément
    public function ContractModelDestroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $contract_model = ContractModel::find($request->id);
        $contract_model->delete();

        return redirect('');
    }
}
