<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Locataire;

class LocataireController extends Controller
{
    public function createLocataire(Request $request)
    {
        try{

            $request->validate([
                'name' => 'required',
                'prenom' => 'required',
                'address' => 'required',
                'telephone' => 'required',
                'email' => 'required',
                'bancaire' => 'required'
            ]);

            $user = $request->user();
            
            $locataire = new Locataire([
                'Nom' => $request->input('name'),
                'Prenom' => $request->input('prenom'),
                'Adresse' => $request->input('address'),
                'Telephone' => $request->input('telephone'),
                'Email' => $request->input('email'),
                'bancaire' => $request->input('bancaire'),
                'ID_user' => $user->ID_user
            ]);

            $locataire->save();
            return redirect()->route('dashboard');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function updateLocataire(Request $request,$id){
        try{
            $locataire = Locataire::find($id);
            
            $locataire->Nom = $request->input('name') ? $request->input('name') : $locataire->Nom;
            $locataire->Prenom = $request->input('prenom') ? $request->input('prenom') : $locataire->Prenom;
            $locataire->Adresse = $request->input('address') ? $request->input('address') : $locataire->Adresse;
            $locataire->Telephone = $request->input('telephone') ? $request->input('telephone') : $locataire->Telephone;
            $locataire->Email = $request->input('email') ? $request->input('email') : $locataire->Email;
            $locataire->bancaire = $request->input('bancaire') ? $request->input('bancaire') : $locataire->bancaire;

            $locataire->save();

            return redirect()->route('dashboard');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

}
