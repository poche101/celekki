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
        Schema::create('live_attendances', function (Blueprint $table) {
            $table->id();

            // Link to the specific stream session
            $table->foreignId('live_stream_id')
                  ->constrained('live_streams')
                  ->onDelete('cascade');

            // Optional link to a registered user
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->string('name');
            $table->string('phone', 50)->nullable();
            $table->enum('status', ['Online', 'Just left'])->default('Online');
            $table->date('attended_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_attendances');
    }
};
