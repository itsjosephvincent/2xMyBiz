<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Deals extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'deal_title',
        'deal_price'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Deal has been {$eventName}")
            ->useLogName('Deals')
            ->logOnly([
                'user_id',
                'deal_title',
                'deal_price'
            ])
            ->logOnlyDirty();
    }
}
