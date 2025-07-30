<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedInUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'linkedin_id',
        'first_name',
        'last_name',
        'token',
        'token_expiry',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
