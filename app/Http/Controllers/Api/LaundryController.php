<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Laundry;
use App\StarchList;
use App\PerfumeList;
use App\KleanaryList;
use App\KleanaryItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Paystack;
use App\Payments;
use App\Coupon;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
class LaundryController extends Controller
{
    public function randStrGennosc($len)
{
    $result ="";
    $chars = "abcdefghijklmnpqrstuvwsyz01234567891111111";
    $charArray = str_split($chars);
    for ($i=0; $i < $len; $i++){ 
        $randItem = array_rand($charArray);
        $result .="".  $charArray[$randItem];
    }
    return $result;
}

      public function makerequest(Request $request)
    {   
         
        $klist = $request->input('klist');
        $laundryimg = $request->input('laundryimg');
        $imgSrc = $request->input('imgSrc');
        $todoIron = $request->input('todoIron');
        $todoHang = $request->input('todoHang');
        $todoPerfume = $request->input('todoPerfume');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $country = $request->input('country');
        $state = $request->input('state');
        $localgov = $request->input('localgov');
        $addr = $request->input('addr');
        $favperfume = $request->input('favperfume');
        $favstarch = $request->input('favstarch');
        $pickupDate = $request->input('pickupDate');
        $deliveryDate = $request->input('deliveryDate');
        $shortNote = $request->input('shortNote');
        $coupon = $request->input('coupon');

        $laundry= new Laundry();

      

         $ironprice = 150;
         $clothestotal=0;
         $len=20;
         $totalnum=0;
         $txref = $this->randStrGennosc($len);
         $dtime = $txref.time();
         $img ="";
         $couponExp="";


          for ($i=0; $i <= count($imgSrc)-1; $i++) {

              $image= $imgSrc[$i]['url'];
              $fl= $imgSrc[$i]['filename'];
              $name=$dtime.$fl;
              $path = public_path('images/users/'.Auth::user()->id.'/limage/'.$name);
              Image::make($image)->resize(400, 400)->save($path);
            
               $img .= json_encode(['filename'=>$name]).',';
                //$img .= $name.','; 
          }

           if($klist != "") {

        $starchname = $favstarch['starchname'];
      //  $favstarchs = explode('|', $favstarchs);
      //  $laundry->favstarch = $favstarchs[0];
        $starchprice = $favstarch['starchprice'];
         $starlist = new StarchList();
         $starlist = $starlist->List();
        foreach ($starlist as $slist) {
            if ($slist['starchname']==$starchname) {
            $starchprice = $slist['starchprice'];
            break;
        }
        }
         $s = ['starchname'=>$starchname, 'starchprice'=>$starchprice];
         $laundry->favstarch = json_encode($s); 
        
        $newk ="";
        $klists =  KleanaryItem::all();
        
        
       for ($i=0; $i < count($klist); $i++) { 
          $kname= $klist[$i]['kname'];
          $kprice= $klist[$i]['kprice'];
           $kqty= $klist[$i]['qty'];
          

            foreach ($klists as $klis) {
            if ($klis['kname']==$kname) {
            $kprice = $klis['kprice']+$starchprice;
            $totalnum = $totalnum+$kqty;

            $subtotal = $kprice*$kqty;
            $clothestotal = $clothestotal+$subtotal;
            $data= ['kname'=>$kname,'kprice'=>$kprice,'qty'=>$kqty];
            $newk .= json_encode($data).',';
         //  $newk .= $kname."|".$kprice."||".$kqty.",";
          
            
            
            break;
        }
        }
        
        }

         $laundry->kleanaryinput =$newk;
         
        }

         
        $perfumename = $favperfume['perfname'];
      //  $favperfumes = explode('|', $favperfumes);
       // $laundry->favperfume = $favperfumes[0];
        $perfumeprice = $favperfume['perfprice'];
        $perflist = new PerfumeList();
        $perflist= $perflist->List();
        foreach ($perflist as $plist) {
            if ($plist['perfname']==$perfumename) {
            $perfumeprice = $plist['perfprice'];
            break;
        }
        }
         $p = ['perfname'=> $perfumename, 'perfprice'=> $perfumeprice];
         $laundry->favperfume = json_encode($p); 
        
      

        $starchinput = "";
        $starchinputs = $todoHang;
       
        $nstarch = count($starchinputs);
        for ($i=0; $i <=count($starchinputs)-1; $i++) { 
            $todo= $starchinputs[$i]['todo'];
          $filename= $dtime.$starchinputs[$i]['filename'];
          // $url= $starchinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,];
            $starchinput .= json_encode($data).',';
           // $starchinput .= $filename.",";

        }
          $laundry->todostarch =  $starchinput; 

         $perfumeinput="";
        $perfumeinputs = $todoPerfume;
       
        $nperfume = count($perfumeinputs);
        for ($i=0; $i <=count($perfumeinputs)-1; $i++) { 
            $todo= $perfumeinputs[$i]['todo'];
          $filename= $dtime.$perfumeinputs[$i]['filename'];
          // $url= $perfumeinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,];
            $perfumeinput .= json_encode($data).',';
           // $perfumeinput .= $filename.",";
        }
          $laundry->todoperfume = $perfumeinput; 

        $ironinput="";
      $ironinputs = $todoIron;
        $niron = count($ironinputs);
        for ($i=0; $i <=count($ironinputs)-1; $i++) { 
          $totalnum = $totalnum + $i;
            $todo= $ironinputs[$i]['todo'];
          $filename= $dtime.$ironinputs[$i]['filename'];
          // $url= $ironinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,];
            $ironinput .= json_encode($data).',';
           // $ironinput .= $filename.",";

        }
         $laundry->todoiron = $ironinput; 


           $laundry->paymentstatus = "n"; 
           $laundry->lstatus = "WAITING"; 
           $laundry->txref = $txref; 

           $laundry->addr = $addr;
        
          $laundry->country = $country;
          $laundry->state = $state;
          $laundry->localgov =$localgov;
          $laundry->shortnote = $shortNote;

        $perfumeprice = $perfumeprice*$nperfume;
        $ironprice = $starchprice+$ironprice;
        $ironprice = $ironprice*$niron;
        $totalprice =  $clothestotal+$perfumeprice+$ironprice;
          if ($coupon !="") {
         $excoupon = Coupon::where('coupon',$coupon)->first();
         if ($excoupon !="") {
           $laundry->coupon = $coupon;
            $couponExp = $excoupon->expire;
           $couponPercent = $excoupon->percent; 
           $percent = $totalprice*$couponPercent;
           $totalprice = $totalprice - $percent;
         }
        }
        $laundry->totalprice = $totalprice; 
        $laundry->laundryimg = $img; 
      
        $laundry->totalnum = $totalnum;
        $laundry->pickup_at = Carbon::parse($pickupDate);
        $laundry->delivery_at = Carbon::parse($deliveryDate);
        $request->user()->laundries()->save($laundry);
        
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        //return Paystack::getAuthorizationUrl($totalprice."00",$txref,$email,$username)->redirectNow();
        return response()->json(['totalprice'=>$totalprice."00",'txref'=>$txref,'email'=>$email,'username'=>$username,'pkey'=>'pk_test_2fc262695039b96d69e55bb57482b4ef532b5437'],200);
        
  
 
      
        
    }

    public function RequestPLaundry()
    {
         $pls = Laundry::where([['user_id',Auth::user()->id],['lstatus','!=','DELIVERED']])->orderBy('created_at', 'DESC')->simplePaginate(10);
         return response()->json(['plaundry'=>$pls],200);

    }

    public function RequestDLaundry()
    {
       $lhs = Laundry::where([['user_id',Auth::user()->id],['lstatus','=','DELIVERED']])->orderBy('created_at', 'DESC')->simplePaginate(10);
        return response()->json(['dlaundry'=>$lhs],200);
    }

    public function viewlaundry(Request $request)
    {
        $single = Laundry::where('id','=',$request['id'])->first();
        $userid = $single['user_id'];

$favperfume = $single['favperfume'];
$favstarch = $single['favstarch'];
$todostarch = $single['todostarch'];
$todoperfume= $single['todoperfume'];
$todoiron = $single['todoiron'];
 $addr = $single['addr'];
 $country = $single['country'];
 $state = $single['state'];
 $localgov = $single['localgov'];
  $totalprice = $single['totalprice'];
  $dtime = $single['created_at'];
  $status = $single['lstatus'];
   $shortnote = $single['shortnote'];
   $txref = $single['txref'];
   $limage = $single['laundryimg'];
   $kinput = $single['kleanaryinput'];
   if($kinput==""){$kinput = "empty";}


// return $tshirt.'|||'.$trouser.'|||'.$bedshit.'|||'.$tie.'|||'.$shoes.'|||'.$bags.'|||'.$towel.'|||'.$favperfume.'|||'.$favstarch.'|||'.$todostarch.'|||'.$todoperfume.'|||'.$todoiron.'|||'.$addr.'|||'.$country.'|||'.$state.'|||'.$localgov.'|||'.$totalprice.'|||'.$dtime.'|||'.$status.'|||'.$userid.'|||'.$shortnote;
     //  return response()->json(['limage'=>$limage,'createdat'=>$dtime,'favperfume'=>$favperfume,'favstarch'=>$favstarch,'todostarch'=>$todostarch,'todoperfume'=>$todoperfume,'todoiron'=>$todoiron,'addr'=>$addr,'country'=>$country,'state'=>$state,'localgov'=>$localgov,'totalprice'=>$totalprice,'lstatus'=>$status,'userid'=>$userid,'shortnote'=>$shortnote,'txref'=>$txref,'kinputs'=>$kinput],200);
        return response()->json(["laundry"=>$single],200);
      }



/*public function PerfumeList()
{
    $perfumelists = [

    '0'=>[
    'perfname'=>'421',
    'perfprice'=>'70'
    ],
    '1'=>[
    'perfname'=>'radel',
    'perfprice'=>'50'
    ],
    '2'=>[
    'perfname'=>'Masello',
    'perfprice'=>'100'
    ],
    '3'=>[
    'perfname'=>'Jagua',
    'perfprice'=>'70'
    ],


    ];
    return $perfumelists;
}
public function StarchList()
{
    $starchlists = [

    '0'=>[
    'starchname'=>'421',
    'starchprice'=>'70'
    ],
    '1'=>[
    'starchname'=>'radel',
    'starchprice'=>'50'
    ],
    '2'=>[
    'starchname'=>'Masello',
    'starchprice'=>'100'
    ],
    '3'=>[
    'starchname'=>'Jagua',
    'starchprice'=>'70'
    ],


    ];
    return $starchlists;
}
*/

public function laundryimage($filename)
{
    
        $file = Storage::url($filename);
       // return new Response($file,200);
        return Image::make(storage_path().$file)->response();
    
}


 public function States(Request $request)
    {
         $states = State::where([['country',$request['country']]]);
         return response()->json(['states'=>$states],200);

    }

     public function confirmStatus(Request $request)
    {
      if ($request['status'] == "PICKED") {
          $laundry = Laundry::where([['user_id',Auth::user()->id],['id','=',$request['id']],['lstatus','=','PICKING']])->first();
      }else {
          $laundry = Laundry::where([['user_id',Auth::user()->id],['id','=',$request['id']],['lstatus','=','DELIVERING']])->first();
      }
    
        $laundry->lstatus= $request['status'];   

        if ( $laundry->update()) {
            return response()->json(['msg'=>'successful','laundry'=>$laundry],200);
        }else{
            return response()->json(['msg'=>'Can not find laundry'], 404);
        }
       
       

    }


     public function giveValue(Request $request)
    {
      
      $txtype = $request['txtype'];
$txref = $request['txref'];
    
        
       
        $pay = new Payments();
        $laundry = Laundry::where('txref','=',$txref)->first();

        if ($txtype === "Cash") {
         
             $laundry->paymentstatus = 'Cash';
             $laundry->update();
           
         
        } else {
          $status = $request['status'];
     
     // $amount = $request['amount'];
           $pay->txref = $txref;
          $pay->uid = $laundry->user_id;
          $pay->status = $status;
           $pay->totalamount = $laundry->totalprice;
           $pay->lid = $laundry->id;
           // $pay->branch = $laundry->picker;
             $laundry->paymentstatus = 'success';
             $laundry->update();
            $pay->save();
        }
        

       

 

          return response()->json(['msg'=>'successful','laundry'=>$laundry, 'status'=>200],200);
    }
}
