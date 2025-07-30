<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostReasonCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'lost_reason_id',
        'user_id',
        'count'
    ];
}
