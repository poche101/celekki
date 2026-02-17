<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('h_lives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('episode');
            $table->text('video_path'); // The Streaming URL
            $table->string('poster_path')->nullable(); // Thumbnail path
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('h_lives');
    }
};
