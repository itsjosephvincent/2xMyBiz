<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LeadClass extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'lead_class_name'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Lead File has been {$eventName}")
            ->useLogName('LeadFile')
            ->logOnly([
                'lead_class_name'
            ])
            ->logOnlyDirty();
    }
}
