<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAffiliatePartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'affiliate_id',
        'link'
    ];
}
