<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Organization extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'lead_group_id',
        'user_id',
        'organization_name',
        'address',
        'owner'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "An Organization has been {$eventName}")
            ->useLogName('Organization')
            ->logOnly([
                'lead_group_id',
                'user_id',
                'organization_name',
                'address',
                'owner'
            ])
            ->logOnlyDirty();
    }
}
