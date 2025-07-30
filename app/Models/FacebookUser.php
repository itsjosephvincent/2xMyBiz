<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FacebookUser extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'facebook_id',
        'email',
        'avatar',
        'facebook_url'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Facebook User has been {$eventName}")
            ->useLogName('FacebookUser')
            ->logOnly([
                'user_id',
                'facebook_id',
                'email',
                'avatar',
                'facebook_url'
            ])
            ->logOnlyDirty();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
