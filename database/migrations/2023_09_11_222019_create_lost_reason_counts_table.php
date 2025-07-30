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
        Schema::create('lost_reason_counts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lost_reason_id');
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_reason_counts');
    }
};
