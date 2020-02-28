<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SignUpRequest;
use App\Models\User;

class SignUpController extends Controller
{

    //Register a newly created resource in storage.

    public function register(SignUpRequest $request)
    {
        // Create New User
        $newUser = new User([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => Hash::make($request->password) ]);

        $newUser->save();

        // Create access token
        $user = $newUser;
        $token = $user->createToken('devlog')->accessToken;

        return response()->json([   
            'message' => 'Created and logged successfully!',
            'user' => $user->makeHidden('id'),
            'token' => 'Bearer '.$token
        ]);	
    }

}
