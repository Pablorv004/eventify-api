<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'organizer_id' => $this->organizer_id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'category_id' => $this->category_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'max_attendees' => $this->max_attendees,
            'price' => $this->price,
            'deleted' => $this->deleted,
            'image_url' => $this->image_url,
            'category' => $this->category->name,
        ];
    }
}
