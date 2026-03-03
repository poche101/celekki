<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::table('viewers', function (Blueprint $table) {
        $table->string('episode_slug')->nullable()->after('location');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('viewers', function (Blueprint $table) {
            //
        });
    }
};
