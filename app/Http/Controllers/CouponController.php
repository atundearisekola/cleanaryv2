<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Coupon;
class CouponController extends Controller
{
     public function addItem(Request $request)
    {
         $this->validate($request,[
           
           
            'coupon'=>'required',
            'percent'=>'required',
            'expire'=>'required',
            
            ]);
        $coupon = new Coupon();

        $coupon->coupon = $request['coupon'];
        $coupon->percent = $request['percent'];
         $coupon->expire = $request['expire'];
       $coupon->admin_id = Auth::user();
        
        if ($coupon->save()) {
              return redirect()->route('coupon')->with(['msg'=>'successfully done']);
          }
    }

     public function Coupons()
    {
         $coupons = Coupon::all();
         return response()->json(['coupons'=>$coupons],200);

    }

     public function deleteItem($id)
    {
         
         $coupon = Coupon::where('id',$id)->first();
  
          if ($coupon->delete()) {
              
              return redirect()->route('coupon')->with(['msg'=>'successfully done']);
          }

    }

     public function updateItem(Request $request)
    {
         $this->validate($request,[
           
           'coupon'=>'required',
            'percent'=>'required',
            'expire'=>'required',
            ]);
          $coupon = new Coupon();

        $coupon->coupon = $request['coupon'];
        $coupon->percent = $request['percent'];
         $coupon->expire = $request['expire'];
        
          if ($coupon->update()) {
              
              return redirect()->route('update-coupon')->with(['msg'=>'successfully done']);
          }

    }  

    public function showCoupons()
    {
         $items = Coupon::all();
        return view('admin.coupon',['items'=>$items]);
    }
}
