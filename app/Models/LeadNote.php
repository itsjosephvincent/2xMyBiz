<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LeadNote extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'lead_id',
        'title',
        'message'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Lead Note has been {$eventName}")
            ->useLogName('LeadNote')
            ->logOnly([
                'lead_id',
                'title',
                'message'
            ])
            ->logOnlyDirty();
    }
}
