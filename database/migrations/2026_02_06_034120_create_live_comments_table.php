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
        Schema::create('live_comments', function (Blueprint $table) {
            $table->id();

            // Link to the stream session
            $table->foreignId('live_stream_id')
                  ->constrained('live_streams')
                  ->onDelete('cascade');

            // Optional link to a registered user account
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->string('user_name'); // To store name even if user_id is null (guests)
            $table->text('comment_text');
            $table->text('admin_reply')->nullable();
            $table->timestamp('posted_at')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_comments');
    }
};
