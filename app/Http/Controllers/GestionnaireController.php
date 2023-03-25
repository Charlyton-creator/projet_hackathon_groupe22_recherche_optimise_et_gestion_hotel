<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestionnaire;
use App\Models\Hotel;
use Validator;
use Illuminate\Support\Facades\Auth;

class GestionnaireController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'email' => 'required|email|max:100|unique:gestionnaires',
            'username' => 'required|string',
            'sexe' => 'required|string',
            'telephone' => 'required'
        ]);
        if($validator->stopOnFirstFailure()->fails()){
            return redirect()->back()->with('validation_errors', $validator->errors());
        }
        if(!isset($request->hotel)){
            return redirect()->back()->with('emptyhotelerror', 'Vous devez associé ce gestionnaire a un hotel');
        }
        $hotele = Hotel::find($request->hotel);
        if(empty($hotele)){
            return redirect()->back()->with('notfounderror', 'Auncun hotel ne correspond a la valeure fournit');
        }

        $gestionnaire = new Gestionnaire();
        $gestionnaire->nom = $request->nom;
        $gestionnaire->adresse = $request->adresse;
        $gestionnaire->username = $request->username;
        $gestionnaire->sexe = $request->sexe;
        $gestionnaire->telephone = $request->telephone;
        $gestionnaire->password = isset($request->password) ? $request->password : "";
        $gestionnaire->hotel()->associate($hotele);

        $gestionnaire->save();
        if(!$gestionnaire->save()){
            return redirect()->back()->with('servererror', 'Le serveur a rencontré une erreur et ne peut poursuivre la demande. Reesayer plus tard');
        }

        return redirect('/gestionnaires')->with('success', 'Le gestionnaire a été enregistré avec succès');
    }
    /**
     * 
     */
    public function logout(Request $request){
        if($request->session()->has('gestionnaire')){
            Auth::guard('gestionnaire')->logout();
            $request->session()->forget('gestionnaire');
            $request->session()->flush();
            return redirect(route('login'))->withSuccess('You have Successfully logged out');;
         }else{
            return redirect()->back();
         }
    }
    /**
     * 
     */
    public function index(int $id = null){
        $gestionnaire = null;
        if($id !=null){
            $gestionnairetoreturn = Gestionnaire::find($id);
        }
        $gestionnaires = Gestionnaire::all();

        return view('dashboard.gestionnaires.list_gestionnaires', compact('gestionnaires', 'gestionnaire'));
    }
    /**
     * 
     */
    public function registerindex(){
        $hotels = Hotel::all();
        return view('dashboard.gestionnaires.add_gestionnaire', compact('hotels'));
    }
    /**
     * 
     */
    private function generaterandompassword(){
        $alpha = "ABCDEFJHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

        $password = substr(str_shuffle($alpha), 0, 8);
    }
}
