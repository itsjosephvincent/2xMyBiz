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
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lead_group_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('organization_name');
            $table->string('address')->nullable();
            $table->string('owner')->nullable();
            $table->timestamps();
        });

        Schema::table('organizations', function ($table) {
            $table->foreign('lead_group_id')->references('id')->on('lead_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
