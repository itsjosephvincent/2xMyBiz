<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'facebook_id',
        'first_name',
        'last_name',
        'email',
        'gender',
        'birthday',
        'password',
        'status',
        'profile_photo'
    ];

    protected $hidden = [
        'password'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user')->useDisk('s3');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}")
            ->useLogName('User')
            ->logOnly([
                'facebook_id',
                'first_name',
                'last_name',
                'email',
                'gender',
                'birthday',
                'password',
                'status',
                'profile_photo'
            ])
            ->logOnlyDirty();
    }

    public function isLastLoginOlderThanSixMonths()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $lastLogin = $this->last_login ? Carbon::parse($this->last_login) : null;

        return $lastLogin !== null && $lastLogin->lte($sixMonthsAgo);
    }

    public function facebook_user()
    {
        return $this->hasOne(FacebookUser::class);
    }

    public function user_business()
    {
        return $this->hasOne(UserBusiness::class);
    }

    public function linkedin_user()
    {
        return $this->hasOne(LinkedInUser::class);
    }
}
