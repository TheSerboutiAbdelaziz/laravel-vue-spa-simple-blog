<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;
use App\Http\Resources\StoryResource;

class StoryController extends Controller
{
    
    //Display a listing of the resource.
    
    public function index()
    {
        return StoryResource::collection(Story::latest()->paginate(3));
    }


    //Display the specified resource.

    public function show($id)
    {
        return new StoryResource(Story::findOrFail($id));
    }

}
