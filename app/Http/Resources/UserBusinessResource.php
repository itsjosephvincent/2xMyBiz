<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBusinessResource extends JsonResource
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
            'user_id' => $this->user_id,
            'business_name' => $this->business_name,
            'business_address' => $this->business_address,
            'business_email' => $this->business_email,
            'business_phone' => $this->business_phone,
            'business_website' => $this->business_website,
            'business_logo' => $this->business_logo,
            'business_banner' => $this->business_banner,
            'myleads_link' => $this->myleads_link,
            'kartra_link' => $this->kartra_link,
            'business_calendar_link' => $this->business_calendar_link,
            'about_us' => $this->about_us,
            'audit_message' => $this->audit_message,
            'created_at' => $this->created_at,
        ];
    }
}
