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
        Schema::create('user_businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('business_name')->nullable();
            $table->string('business_address')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_phone')->nullable();
            $table->string('business_website')->nullable();
            $table->string('business_logo')->nullable();
            $table->string('business_banner')->nullable();
            $table->string('myleads_link')->nullable();
            $table->string('kartra_link')->nullable();
            $table->longText('business_calendar_link')->nullable();
            $table->longText('about_us')->nullable();
            $table->longText('audit_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_businesses');
    }
};
