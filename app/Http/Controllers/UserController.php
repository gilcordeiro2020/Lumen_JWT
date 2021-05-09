<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function __construct()
   {
      // $this->middleware('auth:api');
      $this->middleware('auth', ['only' => 'current']);
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function authenticate(Request $request)
   {
       $this->validate($request, [
       'email' => 'required',
       'password' => 'required'
        ]);
      $userEloquent = User::where('email', $request->input('email'));
      $user = $userEloquent->first();
     if(Hash::check($request->input('password'), $user->password)){
          $apikey = base64_encode(sha1(time()));
          $userEloquent->update(['api_token' => "$apikey"]);
          // return response()->json(['status' => 'success','api_token' => $apikey,'name'=>$user->name,'email'=>$user->email]);
          return response()->json(['status' => 'success','api_token' => $apikey]);
      }else{
          return response()->json(['status' => 'fail'],401);
      }
   }

   public function current(Request $request) {
      $user = Auth::user();
      return response()->json(['status' => 'success','name' => $user->name,'email' => $user->email]);
   }
}    
?>
