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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            // company_name
            $table->string('name');
            // company_email
            $table->string('email');
            // address
            $table->string('address');
            // latitude
            $table->string('latitude');
            // longitude
            $table->string('longitude');
            // radius_km
            $table->string('radius_km');
            // time_in
            $table->string('time_in');
            // time_out
            $table->string('time_out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
