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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('endDate')->nullable();
            $table->string('name');
            $table->string('abbreviation');
            $table->string('phonePrefix');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('regional_council_state_id')->nullable()->default(null);
            $table->foreign('regional_council_state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['regional_council_state_id']);
            $table->dropColumn('regional_council_state_id');
        });
        Schema::dropIfExists('states');
    }
};
