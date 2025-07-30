<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedInCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'industry_code',
        'industry_label',
    ];
}
