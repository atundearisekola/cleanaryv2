<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Country;
class CountryController extends Controller
{
      public function __construct()
    {
       
    }

    public function addCountry(Request $request)
    {
         $this->validate($request,[
           
           
            'country'=>'required',
            ]);
        $country = new Country();

        $country->country = $request['country'];
       
        if ($country->save()) {
                     $countries = Country::all();

              return redirect()->route('country')->with(['msg'=>'successfully done', 'countries'=>$countries]);
          }
    }

     public function showCountry()
    {
         $countries = Country::all();
        return view('admin.add_country',['countries'=>$countries]);
    }

     public function Countries()
    {
         $countries = Country::all();
         return response()->json(['countries'=>$countries],200);

    }

    public function deleteCountry($id)
    {
         
         $country = Country::find('id',$id);
  
          if ($country->delete()) {
             
              return redirect()->route('country')->with(['msg'=>'successfully done ' ]);
          }

    }
}
