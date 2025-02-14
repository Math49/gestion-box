<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
{
    // GET /bills - affiche tout
    public function BillsByUser(Request $request)
    {
        $bills = $request->user()->contracts->bills;

        return view('dashboard', [
            'bills' => $bills,
        ]);
    }

    // GET /bills/{id} - affiche un élément
    public function BillByID(Request $request, $id)
    {
        $bill = Bill::find($id);

        return view('', [
            'bill' => $bill,
        ]);
    }

    // GET /bills/create - affiche le formulaire de création
    public function BillCreate(Request $request)
    {
        return view('');
    }
    // POST /bills - enregistre un élément
    public function BillStore(Request $request)
    {
        $request->validate([
            'payement_price' => 'required',
            'payement_date' => 'required',
            'period_number' => 'required',
            'id_contract' => 'required',
        ]);


        $bill = new Bill();
        $bill->payement_price = $request->payement_price;
        $bill->payement_date = $request->payement_date;
        $bill->period_number = $request->period_number;
        $bill->id_contract = $request->id_contract;
        $bill->save();

        return redirect('');
    }
    // GET /bills/{id}/edit - affiche le formulaire d'édition
    public function BillEdit(Request $request, $id)
    {
        $bill = Bill::find($id);

        return view('', [
            'bill' => $bill,
        ]);
    }

    // PUT /bills/{id}/update - met à jour un élément
    public function BillUpdate(Request $request, $id)
    {
        $request->validate([
            'payement_price' => 'required',
            'payement_date' => 'required',
            'period_number' => 'required',
            'id_contract' => 'required',
        ]);

        $bill = Bill::find($id);

        $bill->payement_price = $request->payement_price ? $request->payement_price : $bill->payement_price;
        $bill->payement_date = $request->payement_date ? $request->payement_date : $bill->payement_date;
        $bill->period_number = $request->period_number ? $request->period_number : $bill->period_number;
        $bill->id_contract = $request->id_contract ? $request->id_contract : $bill->id_contract;
        $bill->save();

        return redirect('');
    }

    // DELETE /bills - supprime un élément
    public function BillDestroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $bill = Bill::find($request->id);
        $bill->delete();

        return redirect('');
    }
}
