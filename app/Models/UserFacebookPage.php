<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserFacebookPage extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'page_id',
        'page_name',
        'page_access_token',
        'page_photo'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Facebook Page has been {$eventName}")
            ->useLogName('FacebookPage')
            ->logOnly([
                'user_id',
                'page_id',
                'page_name',
                'page_access_token',
                'page_photo'
            ])
            ->logOnlyDirty();
    }
}
