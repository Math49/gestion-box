<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Barryvdh\DomPDF\Facade\Pdf;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les factures payées de l'année en cours
        $year = now()->year;
        $bills = Bill::whereYear('payement_date', $year)
            ->whereNotNull('payement_date') // Seules les factures payées
            ->get();

        $totalIncome = $bills->sum('payement_price');

        return view('tax.index', compact('totalIncome'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'total_income' => 'required|numeric',
        ]);

        $totalIncome = $request->total_income;

        if ($totalIncome <= 15000) {
            $taxableIncome = $totalIncome * 0.70; // 70% des revenus imposables
            $case = "4BE - Déclaration 2042";
            $regime = "micro-foncier";
        } else {
            $taxableIncome = $totalIncome; // 100% des revenus
            $case = "4BA - Déclaration 2044";
            $regime = "reel";
        }

        return view('tax.result', compact('totalIncome', 'taxableIncome', 'regime', 'case'));
    }

    public function downloadPDF($total_income, $taxable_income, $regime)
    {
        $pdf = PDF::loadView('tax.pdf', compact('total_income', 'taxable_income', 'regime'));
        return $pdf->download('declaration_impots.pdf');
    }
}
