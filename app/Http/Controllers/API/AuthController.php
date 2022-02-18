<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthCollection;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(Request $request){

        $login=$request->validate([
            'email'=>'required|string',
            'password'=> 'required|string'
        ]);
        if (!Auth::attempt($login)) {
            return  response(["msg"=>'no access'],401);
        }else
        {
            $user =Auth::user();
            $accessToken =Auth::user()->createToken('Token Name')->accessToken;
            return response(["data"=> Auth::user(),'token'=>$accessToken]);
           //return response(["data"=> $user]);
//           //return  new AuthCollection($accessToken);
            //return "hello test";
        }
    }

    /**
     * @param Request $request
     * @return void
     */
    public function logout()
    {
        $user=Auth::user()->token()->revoke();

        return response(["message"=> "log_out"]);
    }
}
