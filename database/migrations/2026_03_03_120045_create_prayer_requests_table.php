<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prayer_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('request');
            $table->boolean('is_reviewed')->default(false); // Admin tracking
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prayer_requests');
    }
};
