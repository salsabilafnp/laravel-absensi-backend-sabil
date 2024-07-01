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
            $table->enum('permit_type', ['annual', 'sick', 'wfh'])->default('annual');
            // permission date start
            $table->date('leave_date');
            // permission duration
            $table->integer('duration');
            // reason
            $table->text('reason');
            // file
            $table->string('file_url')->nullable();
            // status
            $table->enum('status', ['pending','approved', 'rejected'])->default('pending');
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
