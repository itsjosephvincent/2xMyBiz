<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LeadFile extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'lead_id',
        'file_name',
        'file_path'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('lead_file')->useDisk('s3');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Lead File has been {$eventName}")
            ->useLogName('LeadFile')
            ->logOnly([
                'user_id',
                'lead_group_name',
                'class_id'
            ])
            ->logOnlyDirty();
    }
}
