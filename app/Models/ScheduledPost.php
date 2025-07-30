<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ScheduledPost extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'post_id',
        'page_id',
        'title',
        'content',
        'attachment',
        'date',
        'time',
        'is_posted'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('scheduled_media')->useDisk('s3');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Scheduled Post has been {$eventName}")
            ->useLogName('ScheduledPost')
            ->logOnly([
                'user_id',
                'post_id',
                'page_id',
                'title',
                'content',
                'attachment',
                'date',
                'time',
                'is_posted'
            ])
            ->logOnlyDirty();
    }
}
