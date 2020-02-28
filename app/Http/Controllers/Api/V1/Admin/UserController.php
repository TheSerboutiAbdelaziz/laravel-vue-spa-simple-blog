<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    
    //Display a listing of the resource.
        
    public function index()
    {
        //1 === User && 0 === Admin
        if (auth()->user()->role === 0) {
            return UserResource::collection(User::latest()->get());            
        }
    }

    
    //Display the specified resource.

    public function show($id)
    {
        $this->authorize('view', User::find($id));
        return new UserResource(User::findOrFail($id));
    }
  
}
