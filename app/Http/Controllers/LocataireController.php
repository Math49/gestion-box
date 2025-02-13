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

}
