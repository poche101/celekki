<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_testimonies_table.php
public function up()
{
    Schema::create('testimonies', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('group');
        $table->text('content');
        $table->string('video_url')->nullable(); // For video testimonies
        $table->boolean('is_featured')->default(false); // To pin to top
        $table->boolean('is_approved')->default(false); // Moderation layer
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonies');
    }
};
