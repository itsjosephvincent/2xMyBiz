<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacebookResource extends JsonResource
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
            'facebook_id' => $this->facebook_id,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'created_at' => $this->created_at,
        ];
    }
}
