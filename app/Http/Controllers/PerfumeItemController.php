<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\PerfumeItem;

class PerfumeItemController extends Controller
{
    public function addItem(Request $request)
    {
         $this->validate($request,[
           
           
            'perfname'=>'required',
            'perfprice'=>'required',
            
            ]);
        $perfItem = new PerfumeItem();

        $perfItem->perfname = $request['perfname'];
        $perfItem->perfprice = $request['perfprice'];
       
        
        if ($perfItem->save()) {
              return redirect()->route('perfume')->with(['msg'=>'successfully done']);
          }
    }

     public function perfumeItems()
    {
         $perfItems = PerfumeItem::all();
         return response()->json(['perfItems'=>$perfItems],200);

    }

     public function deleteItem($id)
    {
         
         $perfItem = PerfumeItem::where('id',$id)->first();
  
          if ($perfItem->delete()) {
              
              return redirect()->route('perfume')->with(['msg'=>'successfully done']);
          }

    }

     public function updateItem(Request $request)
    {
         $this->validate($request,[
           
           'perfname'=>'required',
            'perfprice'=>'required',
            ]);
          $perfItem = new PerfumeItem();

        $perfItem->perfname = $request['perfname'];
        $perfItem->perfprice = $request['perfprice'];
       
          if ($perfItem->update()) {
              
              return redirect()->route('update-perfume')->with(['msg'=>'successfully done']);
          }

    }  

    public function showPerfumes()
    {
         $items = PerfumeItem::all();
        return view('admin.perfume',['items'=>$items]);
    }
}
