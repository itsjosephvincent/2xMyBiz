<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PostTemplate extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'image'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('postTemplate')->useDisk('s3');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Facebook Post Template has been {$eventName}")
            ->useLogName('PostTemplate')
            ->logOnly([
                'category_id',
                'title',
                'content',
                'image'
            ])
            ->logOnlyDirty();
    }
}
