<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Locataire;

class LocataireController extends Controller
{

    public function LocatairesByUser(Request $request)
    {
        try {
            $user = $request->user();
            $locataires = $user->locataires()->with('payements')->get();
            $boxs = $user->boxs;
            
            return view('locataireView', [
                'locataires' => $locataires,
                'boxs' => $boxs
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }


    public function create(Request $request)
    {
        return view('createLocataire');
    }

    public function viewLocataire(Request $request,$id)
    {
        try{
            $locataire = Locataire::find($id);
            $box = $locataire->box;
            return view('locataireSolo', [
                'locataire' => $locataire,
                'box' => $box
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function editLocataire(Request $request,$id)
    {
        try{
            $locataire = Locataire::find($id);
            return view('locataireEdit', [
                'locataire' => $locataire
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }


    public function createLocataire(Request $request)
    {
        try{

            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'adresse' => 'required',
                'telephone' => 'required',
                'email' => 'required',
                'bancaire' => 'required'
            ]);

            $user = $request->user();
            
            $locataire = new Locataire([
                'Nom' => $request->input('nom'),
                'Prenom' => $request->input('prenom'),
                'Adresse' => $request->input('adresse'),
                'Telephone' => $request->input('telephone'),
                'Email' => $request->input('email'),
                'bancaire' => $request->input('bancaire'),
                'ID_user' => $user->ID_user
            ]);

            $locataire->save();
            return redirect()->route('locataire');

        }catch(Exception $e){
            return dd($e);
        }
    }

    public function updateLocataire(Request $request,$id){
        try{
            $locataire = Locataire::find($id);
            
            $locataire->Nom = $request->input('nom') ? $request->input('nom') : $locataire->Nom;
            $locataire->Prenom = $request->input('prenom') ? $request->input('prenom') : $locataire->Prenom;
            $locataire->Adresse = $request->input('adresse') ? $request->input('adresse') : $locataire->Adresse;
            $locataire->Telephone = $request->input('telephone') ? $request->input('telephone') : $locataire->Telephone;
            $locataire->Email = $request->input('email') ? $request->input('email') : $locataire->Email;
            $locataire->bancaire = $request->input('bancaire') ? $request->input('bancaire') : $locataire->bancaire;

            $locataire->save();

            return redirect()->route('locataire.view', ['id' => $id]);

        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function deleteLocataire(Request $request,$id){
        try{
            $locataire = Locataire::find($id);
            $locataire->delete();
            return redirect()->route('dashboard');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

}
