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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            // user id`
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // permission type
            $table->enum('type', ['annual', 'sick', 'unpaid', 'wfh']);
            // permission date start
            $table->date('start_date');
            // permission date end, null if it's a single day permission
            $table->date('end_date')->nullable();
            // reason
            $table->text('reason');
            // image
            $table->string('image')->nullable();
            // status
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
