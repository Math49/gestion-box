<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Models\Box;
use App\Models\Locataire;
use App\Models\TypeContrat;

class BoxController extends Controller
{
    public function BoxsByUser(Request $request)
    {
        try{
            $user = $request->user();
            $boxs = $user->boxs->with(['typeContrat'])->get();
            return view('dashboard', [
                'boxs' => $boxs
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function createBox()
    {
        $typesContrat = TypeContrat::all();

        return view('createBox', [
            'typesContrat' => $typesContrat
        ]);
    }

    public function updateBox(Request $request,$id){
        try{
            $box = Box::find($id);
            return view('boxEdit', [
                'box' => $box
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function storeBox(Request $request)
    {
        try{

            $user = $request->user();
            
            $box = new Box([
                'Nom' => $request->input('name'),
                'Adresse' => $request->input('address'),
                'Description' => $request->input('description'),
                'ID_typeContrat' => $request->input('type'),
                'Prix' => $request->input('price'),
                'ID_user' => $user->ID_user
            ]);

            $box->save();
            return redirect()->route('dashboard');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function viewBox(Request $request, $id)
    {
        try{
            $box = Box::find($id)->with(['typeContrat'])->get();

            if($box == null){
                return redirect()->back()->with('error', 'Box not found');
            }

            if(!$box->ID_locataire){
                return view('boxView', [
                    'box' => $box,
                ]);
            }

            $locataire = $box->locataire;

            return view('boxView', [
                'box' => $box,
                'locataire' => $locataire
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    // PUT /box/{id}
    public function editBox(Request $request, $id)
    {
        try{

            $box = Box::find($id);
            
            if($box == null){
                return redirect()->back()->with('error', 'Box not found');
            }
            
            $box->Nom = $request->input('name') ? $request->input('name') : $box->Nom;
            $box->Adresse = $request->input('address') ? $request->input('address') : $box->Adresse;
            $box->Description = $request->input('description') ? $request->input('description') : $box->Description;
            $box->Type = $request->input('type');
            $box->Prix = $request->input('price') ? $request->input('price') : $box->Prix;

            $box->ID_locataire = $request->input('locataire') ? $request->input('locataire') : $box->ID_locataire;

            $box->save();

            return redirect()->route('dashboard')->with('success', 'Box updated successfully');


        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function updateBoxLocataire(Request $request, $id)
    {
        $request->validate([
            'ID_box' => 'nullable|exists:boxs,ID_box',
        ]);

        $locataire = Locataire::find($id);
        if ($locataire->boxs()->exists()) {
            $firstBox = $locataire->boxs()->first();
            $firstBox->ID_locataire = null;
            $firstBox->save();
        }

        if($request->input('ID_box') == null){
            return redirect()->back()->with('success', 'Box mise à jour avec succès.');
        }
        
        $box = Box::find($request->input('ID_box'));

        // Mise à jour des box loués
        $box->ID_locataire = $id;
        $box->save();

        return redirect()->back()->with('success', 'Box mise à jour avec succès.');
    }

    // DELETE /box/{id}
    public function deleteBox($id)
    {
        try{

            $box = Box::find($id);
            
            if($box == null){
                return redirect()->back()->with('error', 'Box not found');
            }

            $box->delete();

            return redirect()->route('dashboard')->with('success', 'Box deleted successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
}
