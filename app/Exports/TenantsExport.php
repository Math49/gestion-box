<?php

namespace App\Exports;

use App\Models\Tenant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TenantsExport implements FromCollection, WithHeadings
{
    /**
     * Retourne la collection des locataires.
     */
    public function collection()
    {
        return Tenant::all(['id_tenant', 'name', 'firstname', 'email', 'phone', 'address']);
    }

    /**
     * Définition des en-têtes du fichier CSV.
     */
    public function headings(): array
    {
        return ['ID Locataire', 'Nom', 'Prénom', 'Email', 'Téléphone', 'Adresse'];
    }
}
