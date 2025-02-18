<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentsExport;
use App\Exports\TenantsExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * Export des paiements reçus en Excel.
     */
    public function exportPayments(Request $request)
    {
        return Excel::download(new PaymentsExport(), 'paiements.xlsx');
    }

    /**
     * Export des clients au format CSV.
     */
    public function exportTenants(Request $request)
    {
        return Excel::download(new TenantsExport(), 'clients.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
