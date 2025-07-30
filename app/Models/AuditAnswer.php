<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AuditAnswer extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'page_id',
        'question_id',
        'answer' //1 = Yes, 0 = No
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "An Audit Answer has been {$eventName}")
            ->useLogName('AuditNote')
            ->logOnly([
                'user_id',
                'page_id',
                'question_id',
                'answer' //1 = Yes, 0 = No
            ])
            ->logOnlyDirty();
    }
}
