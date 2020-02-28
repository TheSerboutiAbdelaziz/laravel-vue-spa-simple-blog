<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'timestamps' => [
                'published_at' => [
                    'date' => $this->created_at->toFormattedDateString(),
                    'time' => $this->created_at->format('H:i'),
                ], 
            ],
            'stories_length' => $this->stories->count(),
            'comments_length' => $this->comments->count(),
        ];
    }
}
