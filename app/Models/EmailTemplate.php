<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailTemplate extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'category_id',
        'title',
        'message'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "An Email Template has been {$eventName}")
            ->useLogName('EmailTemplate')
            ->logOnly([
                'category_id',
                'title',
                'message'
            ])
            ->logOnlyDirty();
    }
}
