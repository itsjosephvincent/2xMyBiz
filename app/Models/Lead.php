<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Lead extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'lead_group_id',
        'organization_id',
        'deal_id',
        'lead_id',
        'lead_photo',
        'lead_name',
        'email',
        'website',
        'country',
        'city',
        'state',
        'zip',
        'street',
        'street',
        'link',
        'linkedin'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Lead has been {$eventName}")
            ->useLogName('Lead')
            ->logOnly([
                'user_id',
                'lead_group_id',
                'organization_id',
                'deal_id',
                'lead_id',
                'lead_photo',
                'lead_name',
                'email',
                'website',
                'country',
                'city',
                'state',
                'zip',
                'street',
                'street',
                'link',
                'linkedin',
                'photo'
            ])
            ->logOnlyDirty();
    }
}
