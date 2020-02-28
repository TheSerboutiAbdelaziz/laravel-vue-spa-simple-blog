<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
   
use Illuminate\Http\Request; 
use App\Http\Requests\StoryRequest; 
use App\Models\Story;  
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StoryResource;
use Intervention\Image\Facades\Image;

class StoryController extends Controller
{
    
    //Display a listing of the resource.
    
    public function index()
    {
        //1 === User && 0 === Admin
        if (auth()->user()->role === 0) {
            return StoryResource::collection(Story::latest()->get());            
        }else{
            return StoryResource::collection(Story::where('author_id', Auth::id())->latest()->get());
        }
    }

    
    //Store a newly created resource in storage.

    public function store(StoryRequest $request)
    {   
        if ($request->hasFile('image')) {
            $image = $request->image;
            $fileName = 'story'.'-'.(2*time()).'.'.$image->getClientOriginalExtension();
            Image::make($request->image)->resize(380,256)->save('images/stories/'.$fileName);    
        }
        $createdStory = new StoryResource(Story::create([   
                                            'title' => $request->title, 
                                            'content' => $request->content, 
                                            'category_name' => $request->category_name, 
                                            'image' => $fileName,
                                            'author_id' => Auth::id()
                                        ])
        );
        return response()->json([   'data' => $createdStory,
                                    'message' => 'Created successfully!'
                                ]);
    }

  
    //Display the specified resource.

    public function show($id)
    {
        $this->authorize('view', Story::find($id));
        return new StoryResource(Story::findOrFail($id));
    }


    //Update the specified resource in storage.

    public function update(StoryRequest $request, $id)
    {
        $this->authorize('update', Story::find($id));
        if ($request->hasFile('image')) {
            $image = $request->image;
            $fileName = 'story'.'-'.(2*time()).'.'.$image->getClientOriginalExtension();
            Image::make($request->image)->resize(380,256)->save('images/stories/'.$fileName);    
        }
        new StoryResource(Story::findOrFail($id)->update([  
                                            'title' => $request->title, 
                                            'content' => $request->content, 
                                            'category_name' => $request->category_name, 
                                            'image' => $fileName,
                                            'author_id' => Auth::id()
                                        ])
        );
        return response()->json(['message' => 'Updated successfully!']);
    }



    //Remove the specified resource from storage.
    
    public function destroy($id)
    {
        $this->authorize('delete', Story::find($id));
        new StoryResource(Story::findOrFail($id)->delete());
        return response()->json(['message' => 'Deleted successfully!']);
    }
  
}
