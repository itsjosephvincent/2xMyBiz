<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserDetails extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'country_code',
        'contact_number',
        'company',
        'sales_tax_id',
        'ip_address',
        'ip_country',
        'address1',
        'city',
        'zip',
        'country',
        'state',
        'website',
        'facebook',
        'twitter',
        'linkedin',
        'instagram'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => "User Details has been {$eventName}")
            ->useLogName('UserDetails')
            ->logOnly([
                'user_id',
                'country_code',
                'contact_number',
                'company',
                'sales_tax_id',
                'ip_address',
                'ip_country',
                'address1',
                'city',
                'zip',
                'country',
                'state',
                'website',
                'facebook',
                'twitter',
                'linkedin',
                'instagram'
            ])
            ->logOnlyDirty();
    }
}
