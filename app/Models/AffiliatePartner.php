<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliatePartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sale_tagline',
        'link'
    ];
}
