<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'about',
        'birthday',
        'can_checkin',
        'category',
        'category_list',
        'checkins',
        'cover',
        'display_subtext',
        'fan_count',
        'followers_count',
        'has_transitioned_to_new_page_experience',
        'hours',
        'is_always_open',
        'is_community_page',
        'is_messenger_bot_get_started_enabled',
        'is_messenger_platform_bot',
        'is_owned',
        'is_permanently_closed',
        'is_published',
        'is_unclaimed',
        'verification_status',
        'is_webhooks_subscribed',
        'leadgen_tos_accepted',
        'messenger_ads_default_icebreakers',
        'overall_star_rating',
        'place_type',
        'price_range',
        'rating_count',
        'single_line_address',
        'talking_about_count',
        'temporary_status',
        'username',
        'were_here_count',
        'audit_link'
    ];
}
