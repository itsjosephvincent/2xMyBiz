<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SendNotifications extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'message'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "A Notification has been {$eventName}")
            ->useLogName('SendNotifications')
            ->logOnly([
                'title',
                'message'
            ])
            ->logOnlyDirty();
    }

    public function markAsRead()
    {
        $this->read_at = now(); // Set the "read_at" timestamp to the current time
        $this->save(); // Save the updated notification instance
    }
}
