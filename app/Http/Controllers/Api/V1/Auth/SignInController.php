<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignInRequest;
use Carbon\Carbon;

class SignInController extends Controller
{
    
    public function login(SignInRequest $request)
    {
    	//Get creadentials request	
      	$creadentials = $request->only('email','password');

      	//Authenticate	
    	if (Auth::attempt($creadentials)){

    		// Create access token
    		$user = auth()->user();
    		$token = $user->createToken('devlog')->accessToken;
			
			// //Remmeber token check
			if ($request->remember_token) {
                
			}
			
			//Send success message with token and authenticated user info 
			return response()->json([
				'message' => 'Logged successfully!',
				'user' => $user->makeHidden('id'),
				'token' => 'Bearer '. $token,
			]);					

    	}else{
    		return response()->json(['error' => 'Invalid login creadentials'], 401);
    	}
    }

}
