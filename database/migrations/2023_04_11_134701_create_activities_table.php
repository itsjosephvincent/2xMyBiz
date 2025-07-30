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
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->date('date_from')->nullable();
            $table->time('time_from')->nullable();
            $table->date('date_to')->nullable();
            $table->time('time_to')->nullable();
            $table->enum('status', ['Done', 'Pending'])->default('Pending');
            $table->timestamps();
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->foreign('lead_id')->references('id')->on('leads')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
