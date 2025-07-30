<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'status' => $this->status,
            'profile_photo' => $this->profile_photo,
            'last_login' => $this->last_login,
            'created_at' => $this->created_at,
            'facebook_user' => new FacebookResource($this->whenLoaded('facebook_user')),
            'user_business' => new UserBusinessResource($this->whenLoaded('user_business')),
            'linkedin_user' => new LinkedinUserResource($this->whenLoaded('linkedin_user')),
        ];
    }
}
