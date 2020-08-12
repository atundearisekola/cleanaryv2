<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\StarchItem;
class StarchItemController extends Controller
{
     public function addItem(Request $request)
    {
         $this->validate($request,[
           
           
            'starchname'=>'required',
            'starchprice'=>'required',
            
            ]);
        $starchItem = new StarchItem();

        $starchItem->starchname = $request['starchname'];
        $starchItem->starchprice = $request['starchprice'];
       
        
        if ($starchItem->save()) {
              return redirect()->route('starch')->with(['msg'=>'successfully done']);
          }
    }

     public function starchItems()
    {
         $starchItems = StarchItem::all();
         return response()->json(['starchItems'=>$starchItems],200);

    }

     public function deleteItem($id)
    {
         
         $starchItem = StarchItem::find('id',$id);
  
          if ($starchItem->delete()) {
              
              return redirect()->route('starch')->with(['msg'=>'successfully done']);
          }

    }

     public function updateItem(Request $request)
    {
         $this->validate($request,[
           
           'starchname'=>'required',
            'starchprice'=>'required',
            ]);
          $starchItem = new StarchItem();

        $starchItem->starchname = $request['starchname'];
        $starchItem->starchprice = $request['starchprice'];
        
          if ($starchItem->update()) {
              
              return redirect()->route('update-starch')->with(['msg'=>'successfully done']);
          }

    }  

    public function showStarchs()
    {
         $items = StarchItem::all();
        return view('admin.starch',['items'=>$items]);
    }
}
