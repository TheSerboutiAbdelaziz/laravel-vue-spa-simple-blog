<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Comment;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'img' => $this->image,
            'category' => $this->category_name,
            'timestamps' => [
                'published_at' => [
                    'date' => $this->created_at->toFormattedDateString(),
                    'time' => $this->created_at->format('H:i'),
                ], 
            ],
            'author' => [
                'name' => $this->author->name,
                'avatar' => $this->author->avatar,
            ],
            'comments_length' => $this->comments->count(),
            'comments' => CommentResource::collection(Comment::where('story_id', $this->id)->get()),
        ];
    }
}
