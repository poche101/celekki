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
    Schema::create('episodes', function (Blueprint $table) {
        $table->id();
        $table->string('slug')->unique(); // Store "ep1005", "ep2005", etc.
        $table->string('title');
        $table->string('video_url');
        $table->string('poster')->nullable();
        $table->string('type')->default('mp4'); // 'mp4' or 'hls'
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
