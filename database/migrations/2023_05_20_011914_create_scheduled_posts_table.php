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
        Schema::create('scheduled_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('post_id')->nullable();
            $table->string('page_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->longText('attachment')->nullable();
            $table->enum('platform', ['Facebook', 'LinkedIn', 'Instagram']);
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->boolean('is_posted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_posts');
    }
};
