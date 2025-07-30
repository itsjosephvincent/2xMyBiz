<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LeadGroup extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'lead_group_name',
        'class_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Lead Group has been {$eventName}")
            ->useLogName('LeadGroup')
            ->logOnly([
                'user_id',
                'lead_group_name',
                'class_id'
            ])
            ->logOnlyDirty();
    }
}
