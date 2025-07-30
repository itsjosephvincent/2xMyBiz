<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'activity_type',
        'title',
        'description',
        'date_from',
        'time_from',
        'date_to',
        'time_to'
    ];
}
