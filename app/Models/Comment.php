<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    //The attributes that are mass assignable.
    
    protected $fillable = [
        'content','author_id','story_id',
    ];

 
    //Get the user for the blog comments.

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }  

    //Get the story for the blog comments.

    public function story()
    {
        return $this->belongsTo('App\Models\Story', 'story_id');
    }      

}
