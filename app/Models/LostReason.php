<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LostReason extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'reason'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "An Lost Reason has been {$eventName}")
            ->useLogName('LostReason')
            ->logOnly([
                'user_id',
                'reason'
            ])
            ->logOnlyDirty();
    }
}
