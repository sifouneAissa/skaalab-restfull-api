<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()) return $this->setResult(false,$validator->errors());

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = User::where('email', $request->email)->first();

            return $this->setResult(true,UserResource::make($user)->setWithToken(true),'data',200);
        }

        return $this->setResult();
    }

    public function setResult($success = false,$message = 'Credentials invalid',$key='message',$status=401){
        return response()->json([
            'success' => $success,
            $key => $message
        ],$status);
    }
}
