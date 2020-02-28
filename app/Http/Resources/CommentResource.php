<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'timestamps' => [
                'published_at' => [
                    'date' => $this->created_at->toFormattedDateString(),
                    'time' => $this->created_at->format('H:i'),
                ], 
            ],
            'story_id' => $this->story_id,
            'author' => [
                'name' => $this->author->name,
                'avatar' => $this->author->avatar,
            ],
        ];
    }
}
