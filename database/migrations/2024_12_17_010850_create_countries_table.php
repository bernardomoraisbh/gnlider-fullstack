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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('endDate')->nullable();
            $table->string('alpha2_code', 2); // ISO 3166-1 alpha-2 code
            $table->string('alpha3_code', 3); // ISO 3166-1 alpha-3 code
            $table->integer('numeric_code'); // Numeric code
            $table->string('code'); // Numeric code
            $table->string('name'); // Full name of the country
            $table->string('flag'); // URL or path to the flag image
            $table->string('capital'); // Capital city
            $table->string('currency', 3); // Currency ISO code (e.g., USD, EUR)
            $table->string('phone_prefix'); // International dialing code
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
