<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserProfileSocialLink extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'instagram'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "User Social Links has been {$eventName}")
            ->useLogName('UserProfileSocialLink')
            ->logOnly([
                'user_id',
                'facebook',
                'twitter',
                'linkedin',
                'youtube',
                'instagram'
            ])
            ->logOnlyDirty();
    }
}
