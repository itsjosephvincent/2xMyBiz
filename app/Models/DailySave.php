<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'count',
    ];
}
