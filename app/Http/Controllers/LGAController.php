<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\LocalGov;
use App\State;
use App\Country;
class LGAController extends Controller
{
     public function addLGA(Request $request)
    {
         $this->validate($request,[
           
           
            'lga'=>'required',
            'state'=>'required',
            'country'=>'required',
            ]);
        $lga = new LocalGov();

        $lga->LGA = $request['lga'];
        $lga->state = $request['state'];
        $lga->country = $request['country'];
         $lga->lat = $request['lat'];
          $lga->log = $request['log'];
           $lga->area = $request['area'];
            $lga->population = $request['population'];
        if ($lga->save()) {
              return redirect()->route('lga')->with(['msg'=>'successfully done']);
          }
    }

     public function LGAs(Request $request)
    {
         $lgas = LocalGov::where([['state',$request['state']], ['country',$request['country']]])->orderBy('LGA')->simplePaginate(10);
         return response()->json(['LGAs'=>$lgas],200);

    }

     public function deleteLGA($id)
    {
         
         $lga = LocalGov::where('id',$id)->first();
  
          if ($lga->delete()) {
              
              return redirect()->route('lga')->with(['msg'=>'successfully done']);
          }

    }

     public function updateLGA(Request $request)
    {
         $this->validate($request,[
           
           'lga'=>'required',
            'state'=>'required',
            'country'=>'required',
            ]);
         $lga = LocalGov::find('id',$request['id']);
 
         $lga->LGA = $request['LGA'];
        $lga->state = $request['state'];
        $lga->country = $request['country'];
         $lga->lat = $request['lat'];
          $lga->log = $request['log'];
           $lga->area = $request['area'];
            $lga->population = $request['population'];
          if ($lga->update()) {
              
              return redirect()->route('update-LGA')->with(['msg'=>'successfully done']);
          }

    }

     public function showLGAs()
    {
         $lgas = LocalGov::all();
          $countries = Country::all();
           $states = State::all();
        return view('admin.lga',['lgas'=>$lgas, 'states'=>$states, 'countries' => $countries]);
    }

    public function showSearchLGAs(Request $request)
    {
      
          $lgas = LocalGov::where([['state',$request['state']]])->orderBy('LGA')->simplePaginate(10);
          $countries = Country::all();
           $states = State::all();
        return view('admin.lga',['lgas'=>$lgas, 'states'=>$states, 'countries' => $countries]);
    }
}
