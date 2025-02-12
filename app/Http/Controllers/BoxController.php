<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Models\Box;

class BoxController extends Controller
{
    public function BoxsByUser(Request $request)
    {
        try{
            $user = $request->user();
            $boxs = $user->boxs;
            return view('dashboard', [
                'boxs' => $boxs
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function createBox()
    {
        return view('createBox');
    }

    public function storeBox(Request $request)
    {
        try{

            $user = $request->user();
            
            $box = new Box([
                'Nom' => $request->input('name'),
                'Adresse' => $request->input('address'),
                'Description' => $request->input('description'),
                'Type' => $request->input('type'),
                'ID_user' => $user->ID_user
            ]);

            $box->save();
            return redirect()->route('dashboard');

        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
}
