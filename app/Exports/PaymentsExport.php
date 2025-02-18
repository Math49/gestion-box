<?php

namespace App\Exports;

use App\Models\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromCollection, WithHeadings
{
    /**
     * Retourne la collection des paiements reçus.
     */
    public function collection()
    {
        return Bill::whereNotNull('payement_date')
            ->get(['id_bill', 'payement_price', 'payement_date', 'id_contract']);
    }

    /**
     * Définition des en-têtes du fichier Excel.
     */
    public function headings(): array
    {
        return ['ID Facture', 'Montant (€)', 'Date de Paiement', 'ID Contrat'];
    }
}
