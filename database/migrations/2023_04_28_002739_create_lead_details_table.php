<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lead_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->string('about')->nullable();
            $table->string('birthday')->nullable();
            $table->boolean('can_checkin')->nullable();
            $table->string('category')->nullable();
            $table->json('category_list')->nullable();
            $table->unsignedBigInteger('checkins')->nullable();
            $table->json('cover')->nullable();
            $table->string('display_subtext')->nullable();
            $table->unsignedBigInteger('fan_count')->nullable();
            $table->unsignedBigInteger('followers_count')->nullable();
            $table->boolean('has_transitioned_to_new_page_experience')->nullable();
            $table->json('hours')->nullable();
            $table->boolean('is_always_open')->nullable();
            $table->boolean('is_community_page')->nullable();
            $table->boolean('is_messenger_bot_get_started_enabled')->nullable();
            $table->boolean('is_messenger_platform_bot')->nullable();
            $table->boolean('is_owned')->nullable();
            $table->boolean('is_permanently_closed')->nullable();
            $table->boolean('is_published')->nullable();
            $table->boolean('is_unclaimed')->nullable();
            $table->string('verification_status')->nullable();
            $table->boolean('is_webhooks_subscribed')->nullable();
            $table->boolean('leadgen_tos_accepted')->nullable();
            $table->json('messenger_ads_default_icebreakers')->nullable();
            $table->decimal('overall_star_rating', 10, 2)->nullable();
            $table->enum('place_type', ['CITY', 'COUNTRY', 'EVENT', 'GEO_ENTITY', 'PLACE', 'RESIDENCE', 'STATE_PROVINCE', 'TEXT'])->nullable();
            $table->string('price_range')->nullable();
            $table->unsignedBigInteger('rating_count')->nullable();
            $table->unsignedBigInteger('talking_about_count')->nullable();
            $table->string('temporary_status')->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('were_here_count')->nullable();
            $table->string('audit_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_details');
    }
};
