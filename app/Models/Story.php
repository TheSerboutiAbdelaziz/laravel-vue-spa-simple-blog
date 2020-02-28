<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    //The table associated with the model.
    
    protected $table = 'stories';


    //The attributes that are mass assignable.
    
    protected $fillable = [
        'title', 'content', 'image','category_name','author_id'
    ];


    //Get the user for the blog stories.

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }  

    //Get the comments for the blog story.

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'story_id');
    }  

}
