<?php
namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Box;
use App\Models\Locataire;

class ContratController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $boxs = $user->boxs()->with(['locataire'])->get();
        $contrats = Contrat::with('locataire')->where('ID_user', $user->ID_user)->get();

        return view('contratsView', [
            'boxs' => $boxs,
            'contrats' => $contrats
        ]);
    }

    public function types()
    {
        return view('contratTypesView');
    }

    public function edit(Request $request, $type)
    {
        $path = storage_path("app/contrats/{$type}_{$request->user()->ID_user}.tkt");
        $contenu = file_exists($path) ? file_get_contents($path) : '';

        return view('contratEditView', [
            'contratType' => $type,
            'contenu' => $contenu
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $boxs = $user->boxs()->get();
        $locataires = $user->locataires()->get();

        return view('contratCreateView', compact('boxs', 'locataires'));
    }


    public function update(Request $request, $type)
    {
        Storage::put("contrats/{$type}_{$request->user()->ID_user}.tkt", $request->contenu);
        return redirect()->route('contrat.types')->with('success', 'Contrat mis à jour avec succès.');
    }

    public function download($id)
    {
        try{

        
            $contrat = Contrat::findOrFail($id);
            $txtPath = storage_path("app/contrats_txt/contrat_{$contrat->ID_box}_{$contrat->ID_locataire}_{$contrat->ID_contrat}.txt");
            
            if (!file_exists($txtPath)) {
                return redirect()->back()->with('error', 'Le fichier du contrat n\'existe pas.');
            }


            return response()->download($txtPath);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_box' => 'required|exists:boxs,ID_box',
            'ID_locataire' => 'required|exists:locataires,ID_locataire',
            'Date_debut' => 'required|date',
            'Date_fin' => 'required|date|after:Date_debut',
        ]);

        try {
            $box = Box::findOrFail($request->ID_box);
            $locataire = Locataire::findOrFail($request->ID_locataire);

            // Charger le modèle de contrat correspondant au type du box
            $contratType = strtolower($box->Type);
            $contratTemplatePath = storage_path("app/contrats/{$contratType}_{$request->user()->ID_user}.tkt");

            if (!file_exists($contratTemplatePath)) {
                return redirect()->back()->with('error', 'Le modèle de contrat n\'existe pas.');
            }

            $contratTemplate = file_get_contents($contratTemplatePath);

            // Remplacement des placeholders
            $contratContent = str_replace([
                '{NOM_LOCATAIRE}', '{PRENOM_LOCATAIRE}', '{ADRESSE_BOX}', '{DATE_DEBUT}', '{DATE_FIN}'
            ], [
                $locataire->Nom, $locataire->Prenom, $box->Adresse, $request->Date_debut, $request->Date_fin
            ], $contratTemplate);

            // Création et sauvegarde du contrat dans la base de données
            $contrat = Contrat::create([
                'ID_box' => $request->ID_box,
                'ID_locataire' => $request->ID_locataire,
                'Date_debut' => $request->Date_debut,
                'Date_fin' => $request->Date_fin,
                'ID_user' => $request->user()->ID_user,
                'Status' => "En cours",
                'Lien' => '/'
            ]);
            $contrat->save();

            $contrat = Contrat::findOrFail($contrat->ID_contrat);
            // Maintenant que l'ID existe, on génère le nom du fichier
            $txtFileName = "contrat_{$request->ID_box}_{$request->ID_locataire}_{$contrat->ID_contrat}.txt";
            $txtPath = "contrats_txt/{$txtFileName}";

            // Mettre à jour le lien du fichier TXT dans la base de données
            $contrat->Lien = $txtPath;
            $contrat->save();

            // Enregistrer le contenu du contrat dans un fichier TXT
            Storage::put($txtPath, $contratContent);

            return redirect()->route('contrat.index')->with('success', 'Contrat créé et fichier .txt généré.');
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }

}
