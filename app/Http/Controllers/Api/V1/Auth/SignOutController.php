<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SignOutController extends Controller
{

    public function logout(Request $request)
    {
    		$user = $request->user();
    		$token = $user->token()->revoke();	

    		return response()->json(['message' => 'You have been succesfully logged out!']);
    }

}
