<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractModel;
use App\Models\Box;
use App\Models\Tenant;
use App\Models\Bill;

class ContractController extends Controller
{
    // ✅ GET /contracts - Liste tous les contrats
    public function ContractsByUser(Request $request)
    {
        $contracts = $request->user()->contracts()->with(['box', 'tenant'])->get();
        $boxes = $request->user()->boxes()->get();
        $tenants = $request->user()->tenants()->get();

        return view('contracts.index', compact('contracts', 'boxes', 'tenants'));
    }

    // ✅ GET /contracts/{id} - Affiche un contrat et ses factures
    public function ContractByID(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        $box = $contract->box;
        $tenant = $contract->tenant;
        $bills = $contract->bills()->get();

        return view('contracts.show', [
            'contract' => $contract,
            'box' => $box,
            'tenant' => $tenant,
            'bills' => $bills,
        ]);
    }

    // ✅ GET /contracts/create - Affiche le formulaire de création
    public function ContractCreate(Request $request)
    {
        $contract_models = $request->user()->contractsModels()->get();
        $boxes = $request->user()->boxes()->get();
        $tenants = $request->user()->tenants()->get();

        return view('contracts.create', compact('contract_models', 'boxes', 'tenants'));
    }

    // ✅ POST /contracts - Enregistre un nouveau contrat et génère les factures
    public function ContractStore(Request $request)
    {
        $request->validate([
            'id_box' => 'required',
            'id_tenant' => 'required',
            'id_contract_model' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'monthly_price' => 'required',
        ]);

        $user = $request->user();
        $contractModel = ContractModel::findOrFail($request->input('id_contract_model'));
        $box = Box::findOrFail($request->input('id_box'));
        $tenant = Tenant::findOrFail($request->input('id_tenant'));


        // 🔄 Remplacement des placeholders dans le modèle de contrat
        $contractContent = str_replace(
            ['{NOM_LOCATAIRE}', '{PRENOM_LOCATAIRE}', '{ADRESSE_BOX}', '{DATE_DEBUT}', '{DATE_FIN}'],
            [$tenant->name, $tenant->firstname, $box->address, $request->date_start, $request->date_end],
            $contractModel->content
        );

        // 📝 Création du contrat
        $contract = Contract::create([
            'id_user' => $user->id_user,
            'id_box' => $request->input('id_box'),
            'id_tenant' => $request->input('id_tenant'),
            'content' => $contractContent,
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'monthly_price' => $request->input('monthly_price'),
        ]);


        // 📆 Génération des factures mensuelles
        $start = now()->parse($request->input('date_start'));
        $periods = ceil($start->diffInMonths(now()));
        $end = now()->parse($request->input('date_end'));

        $start = $start->addMonths(-1);

        if ($periods > 0) {
            for ($i = 0; $i <= $periods; $i++) {
                $start->addMonths()->format('Y-m-d');

                if ($start->greaterThanOrEqualTo(now()) && $start->greaterThanOrEqualTo($end)) {
                    break;
                }

                Bill::create([
                    'payement_price' => $request->input('monthly_price'),
                    'creation_date' => $start,
                    'payement_date' => null,
                    'period_number' => $i + 1,
                    'id_contract' => $contract->id_contract,
                ]);
            }
        }

        return redirect()->route('contract.index')->with('success', 'Contrat et factures créés avec succès.');
    }

    // ✅ GET /contracts/{id}/edit - Affiche le formulaire d'édition
    public function ContractEdit(Request $request, $id)
    {
        $contract = Contract::with(['box', 'tenant'])->findOrFail($id);
        $tenants = $request->user()->tenants()->get();

        return view('contracts.edit', compact('contract', 'tenants'));
    }

    // ✅ PUT /contracts/{id}/update - Met à jour un contrat
    public function ContractUpdate(Request $request, $id)
    {
        $request->validate([
            'id_box' => 'required|exists:boxes,id_box',
            'id_tenant' => 'required|exists:tenants,id_tenant',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after:date_start',
            'monthly_price' => 'required|numeric|min:0',
        ]);

        $contract = Contract::findOrFail($id);

        // 🔄 Mise à jour des informations
        $contract->update([
            'id_box' => $request->id_box,
            'id_tenant' => $request->id_tenant,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'monthly_price' => $request->monthly_price,
        ]);

        return redirect()->route('contract.show', $id)->with('success', 'Contrat mis à jour.');
    }

    // ✅ DELETE /contracts - Supprime un contrat et ses factures
    public function ContractDestroy(Request $request)
    {
        $id = $request->input('id_contract');
        $contract = Contract::with('bills')->findOrFail($id);

        // ❌ Suppression des factures associées
        $contract->bills()->delete();
        $contract->delete();

        return redirect()->route('contract.index')->with('success', 'Contrat supprimé.');
    }

    public function downloadPDF(Request $request, $id)
    {
        // Récupérer le contrat et charger ses relations
        $contract = Contract::findOrFail($id)->load('box', 'tenant');

        // Décoder le contenu JSON de l'éditeur
        $contractContent = json_decode($contract->content, true);

        // Convertir le contenu JSON en HTML
        $htmlContent = $this->convertEditorJSToHTML($contractContent);

        // Générer le PDF avec la vue
        $pdf = PDF::loadView('contract-pdf', compact('contract', 'htmlContent'));

        // Télécharger le fichier PDF
        return $pdf->download('contrat_' . $contract->id_contract . '.pdf');
    }

    /**
     * Convertit un contenu EditorJS en HTML propre
     */
    private function convertEditorJSToHTML($editorData)
    {
        $html = '';

        foreach ($editorData['blocks'] as $block) {
            switch ($block['type']) {
                case 'paragraph':
                    $html .= "<p>{$block['data']['text']}</p>";
                    break;
                case 'header':
                    $html .= "<h{$block['data']['level']}>{$block['data']['text']}</h{$block['data']['level']}>";
                    break;
                case 'list':
                    $tag = $block['data']['style'] === 'unordered' ? 'ul' : 'ol';
                    $html .= "<{$tag}>";
                    foreach ($block['data']['items'] as $item) {
                        $html .= "<li>{$item}</li>";
                    }
                    $html .= "</{$tag}>";
                    break;
                case 'quote':
                    $html .= "<blockquote>{$block['data']['text']}</blockquote>";
                    break;
                case 'table':
                    $html .= "<table border='1' cellspacing='0' cellpadding='5'>";
                    foreach ($block['data']['content'] as $row) {
                        $html .= "<tr>";
                        foreach ($row as $cell) {
                            $html .= "<td>{$cell}</td>";
                        }
                        $html .= "</tr>";
                    }
                    $html .= "</table>";
                    break;
                default:
                    $html .= "<p>{$block['data']['text']}</p>";
                    break;
            }
        }

        return $html;
    }
}
