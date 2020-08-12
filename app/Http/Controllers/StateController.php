<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\State;
use App\Country;

class StateController extends Controller
{
     public function addState(Request $request)
    {
         $this->validate($request,[
           
           
            'state'=>'required',
            'country'=>'required',
            ]);
        $state = new State();

        $state->state = $request['state'];
         $state->country = $request['country'];
           $state->lat = $request['lat'];
          $state->log = $request['long'];
           $state->area = $request['area'];
            $state->population = $request['population'];
       
        if ($state->save()) {
              return redirect()->route('state')->with(['msg'=>'successfully done']);
          }
    }

     public function States(Request $request)
    {
        $country = $request['country'];
           
         $states = State::where([['country',$country]])->orderBy('created_at', 'DESC')->simplePaginate(10);
         return response()->json(['states'=>$states],200);

    }

     public function deleteState($id)
    {
         
         $state = State::find($id);
  
          if ($state->delete()) {
              
              return redirect()->route('state')->with(['msg'=>'successfully done']);
          }

    }

     public function updateState(Request $request)
    {
         $this->validate($request,[
           
           
            'state'=>'required',
            ]);
         $state = State::find('id',$request['id']);
  
        $state->state = $request['state'];
         $state->lat = $request['lat'];
          $state->long = $request['long'];
           $state->area = $request['area'];
            $state->population = $request['population'];
          if ($state->update()) {
              
              return redirect()->route('update-state')->with(['msg'=>'successfully done']);
          }

    }

    public function showState()
    {
         $states = State::all();
         $countries = Country::all();
        return view('admin.state',['states'=>$states, 'countries'=>$countries]);
    }
}
