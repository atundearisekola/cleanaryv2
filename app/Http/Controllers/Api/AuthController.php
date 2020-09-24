<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\User;
use App\StarchList;
use App\PerfumeList;
use App\KleanaryList;

class AuthController extends Controller
{
    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email.'-'.now());

        return $token->accessToken;
    }


    public function register(Request $request)
    {

       
        $request->validate([
            'name' => 'required', 
            'fname' => 'required', 
             'lname' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|min:6'
        ]);

        $existenUser = User::where('email', $request->email)->first();
        if ($existenUser !=null) {
           
           return response()->json([
            'error' => "user already exist",
           
          
           ],409);
        }else {

           
           /* $user = User::create([
            'name' => $request->name, 
            'fname' => $request->fname, 
            'lname' => $request->lname, 
            'email' => $request->email, 
            'password' => bcrypt($request->password)
        ]);
        */

         $user = new User();
         $user->fname = $request->fname;
         $user->lname = $request->lname;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = bcrypt($request->password);
          $s = ['starchname'=>"EazyOn", 'starchprice'=>30];
        $user->favstarch= $s;
         $p = ['perfname'=>"none", 'perfprice'=>0];
        $user->favperf= $p;
         if ($user->save()) {
              $token = $user->createToken($user->email.'-'.now());
               $path = public_path('images/users/'.$user->id.'/limage/');
            if (! File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
            }
    
        return response()->json([
            'token' => $token->accessToken,
           'user' => $user,
          
        ]);
         }
        }

       
          
     
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email', 
        'password' => 'required'
    ]);

    if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
        $user = Auth::user();

        $token = $user->createToken($user->email.'-'.now());

        $getList = $this->getLists();

        return response()->json([
            'token' => $token->accessToken,
           'user' => $user,
           'getLists'=>$getList,
        ]);
    }
}

  public function getLists()
    {
        $perflist = new PerfumeList();
        $perflist= $perflist->List();
         $starlist = new StarchList();
         $starlist = $starlist->List();
          $klists = new KleanaryList();
        $klists= $klists->List();
        return response()->json(['klists'=>$klists, 'starchlists'=>$starlist, 'perfumelists'=>$perflist]);
    }





}
