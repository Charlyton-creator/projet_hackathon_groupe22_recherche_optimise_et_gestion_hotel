<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Hotel;

class HotelController extends Controller
{
    //
    /**
     * 
     */
    public function index(){
        $hotels = Hotel::all();
        return view('dashboard.hotels.list_hotels', compact('hotels'));
    }
    /**
     * 
     */
    public function getHotelById($id){
        $hotel = null;
        if($id != null){
            $hotel = Hotel::find($id);
        }
        return view('dashboard.hotels.details', compact('hotel'));
    }
    /**
     * 
     */
    public function getHotelByGestionnaireId($gestionnaire_id){
        
    }
    /**
     * 
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'designation' => 'required|string|max:100|unique:hotels',
            'adresse' => 'required|string',
            'region' => 'required|string',
            'ville' => 'required|string',
            'description' => 'required|max:250',
            'mockup' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        if($validator->stopOnFirstFailure()->fails()){
            return redirect()->back()->with('validation_errors', "Votre formulaire contient des erreurs.".$validator->errors());
        }
        if(isset($request->mockup)){
            $fileName = time().'.'.$request->mockup->extension();
            $request->mockup->move(public_path('images_hotels'), $fileName);

        }
        $hotel = new Hotel();
        $hotel->designation = $request->designation;
        $hotel->adresse = $request->adresse;
        $hotel->ville = $request->ville;
        $hotel->region = $request->region;
        $hotel->note = $request->note;
        $hotel->description = $request->description;
        $hotel->mockup = isset($request->mockup) ?  $fileName : '';
        
        $hotel->save();
        return redirect()->back()->with('success_registerting', "Hotel enregistré avec succès. Vous pouvez assigner la gestion a un gestionnaire");
        if(!$hotel->save()){
            return redirect()->back()->with('server_error', "Le serveur a rencontré un problème. Veuillez ressayer. Si le problème persiste, veuillez contacter le WebMaster");
        }
    }
}
