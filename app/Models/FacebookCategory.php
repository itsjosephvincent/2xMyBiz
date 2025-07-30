<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FacebookCategory extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'facebook_category_name'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Facebook Category has been {$eventName}")
            ->useLogName('FacebookCategory')
            ->logOnly([
                'facebook_category_name'
            ])
            ->logOnlyDirty();
    }
}
