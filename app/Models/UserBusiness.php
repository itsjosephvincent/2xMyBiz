<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserBusiness extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'business_name',
        'business_address',
        'business_email',
        'business_phone',
        'business_website',
        'business_logo',
        'business_banner',
        'business_calendar_link',
        'myleads_link',
        'kartra_link',
        'about_us',
        'audit_message'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('business_banner')->useDisk('s3');
        $this->addMediaCollection('business_logo')->useDisk('s3');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "User Business has been {$eventName}")
            ->useLogName('UserBusiness')
            ->logOnly([
                'user_id',
                'business_name',
                'business_address',
                'business_email',
                'business_phone',
                'business_website',
                'business_logo',
                'business_banner',
                'business_calendar_link',
                'myleads_link',
                'kartra_link',
                'about_us',
                'audit_message'
            ])
            ->logOnlyDirty();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
