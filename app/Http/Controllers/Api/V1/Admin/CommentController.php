<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Story;  
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    
    //Display a listing of the resource.
    
    public function index()
    {
        //1 === User && 0 === Admin
        if (auth()->user()->role === 0) {
            return CommentResource::collection(Comment::latest()->get());            
        }else{
            return CommentResource::collection(Comment::where('author_id', Auth::id())->latest()->get());
        }
    }

    
    //Store a newly created resource in storage.

    public function store(Request $request)
    {
        $request->validate(['content' => 'bail | required | max:255']);
        $createdComment = new CommentResource( 
            Comment::create(['content' => $request->content,'author_id' => Auth::id(),'story_id' => $request->story_id])
        );
        return response()->json([   'data' => $createdComment,
                                    'message' => 'Created successfully!'
                                ]);
    }

    
    //Remove the specified resource from storage.
    
    public function destroy($id)
    {
        $this->authorize('delete', Comment::find($id));
        new CommentResource(Comment::findOrFail($id)->delete());
        return response()->json(['message' => 'Deleted successfully!']);
    }
  
}
