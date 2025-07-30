<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BlockedLead extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'page_name',
        'page_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A blocked lead has been {$eventName}")
            ->useLogName('BlockedLead')
            ->logOnly([
                'user_id',
                'page_name',
                'page_id'
            ])
            ->logOnlyDirty();
    }
}
