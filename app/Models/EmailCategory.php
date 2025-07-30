<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailCategory extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'category_name'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "An Email Category has been {$eventName}")
            ->useLogName('EmailCategory')
            ->logOnly([
                'category_name'
            ])
            ->logOnlyDirty();
    }
}
