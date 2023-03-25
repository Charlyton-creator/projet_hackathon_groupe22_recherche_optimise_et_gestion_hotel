<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Gestionnaire;

class AdminController extends Controller
{
    //
    /**
     * 
     */
    public function loginindex(){
        return view('dashboard.login_admin');
    }
    /**
     * 
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:100',
            //'password' => 'required|min:8',
            'submit' => 'required'
        ]);
        if($validator->stopOnFirstFailure()->fails()){
            return redirect()->back()->with('validation_errors', 'Votre formulaire contient des erreurs'.$validator->errors());
        }
        if($request->submit){
            switch($request->submit){
                case 'admin':
                    $admin = Admin::where('email', $request->email)->first();
                    if(!empty($admin)){
                        if(!$admin OR $request->password != $admin->password){
                            return redirect()->back()->with('invalidcredentialserrors', 'Vous avez entre des informations de connexion incorrects!');
                        }else{
                            Auth::guard('admin')->login($admin);
                            session()->put('admin', $admin);
                            return redirect(route('dashboard'))->withSuccess("You have Successfully logged in");
                        }
                    }
                    break;
                case 'gestionnaire':
                    $gestionnaire = Gestionnaire::where('username', $request->email)->orWhere('email', $request->email)->first();
                    if(!empty($gestionnaire)){
                        if(!$gestionnaire OR $request->password != $gestionnaire->password){
                            return redirect()->back()->with('invalidcredentialserrors', 'Vous avez entre des informations de connexion incorrects!');
                        }else{
                            Auth::guard('gestionnaire')->login($gestionnaire);
                            session()->put('gestionnaire', $gestionnaire);
                            return redirect(route('dashboard'))->withSuccess("You have Successfully logged in");
                        }
                    }
                    break;
                default:
                return redirect(route('login'));
                break;
            }
        }
    }
    /**
     * logout the admin
     */
    public function logout(Request $request){
        if($request->session()->has('admin')){
            Auth::guard('admin')->logout();
            $request->session()->forget('admin');
            $request->session()->flush();
            return redirect(route('login'))->withSuccess('You have Successfully logged out');;
         }else{
            return redirect()->back();
         }
    }
    /**
     * dashboard
     */
    public function dashboard(){
        return view('dashboard/dashboard_index');
    }
}
