<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'created_at' => $this->created_at,
                'edited_at' => $this->updated_at
            ],
            'relationships' => [
                'user_id' => (string)$this->user_id,
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
            ]
        ];
    }
}
