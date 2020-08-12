<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\KleanaryItem;

class KleanaryItemController extends Controller
{
     public function addItem(Request $request)
    {
         $this->validate($request,[
           
           
            'kname'=>'required',
            'kprice'=>'required',
            
            ]);
        $kleanaryItem = new KleanaryItem();

        $kleanaryItem->kname = $request['kname'];
        $kleanaryItem->kprice = $request['kprice'];
   
        
        if ($kleanaryItem->save()) {
              return redirect()->route('kitem')->with(['msg'=>'successfully done']);
          }
    }

     public function kleanaryItems()
    {
         $kleanaryItems = KleanaryItem::all();
         return response()->json(['kleanaryItems'=>$kleanaryItems],200);

    }

     public function showKleanaryItems()
    {
         $items = KleanaryItem::all();
        return view('admin.KleanaryItems',['items'=>$items]);
    }

     public function deleteItem($id)
    {
         
         $kleanaryItem = KleanaryItem::where('id',$id)->first();
  
          if ($kleanaryItem->delete()) {
              
              return redirect()->route('kitem')->with(['msg'=>'successfully done']);
          }

    }

     public function updateItem(Request $request)
    {
         $this->validate($request,[
           
           'kname'=>'required',
            'kprice'=>'required',
            ]);
          $kleanaryItem = new KleanaryItem();

        $kleanaryItem->kname = $request['kname'];
        $kleanaryItem->kprice = $request['kprice'];
       
          if ($kleanaryItem->update()) {
              
              return redirect()->route('update-Item')->with(['msg'=>'successfully done']);
          }

    }
}
