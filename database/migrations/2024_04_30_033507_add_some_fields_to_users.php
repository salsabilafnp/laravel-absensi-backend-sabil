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
        Schema::table('users', function (Blueprint $table) {
            // phone
            $table->string('phone_number')->nullable();
            // role
            $table->enum('role', ['staff', 'admin'])->default('staff');
            // employee_type
            $table->enum('employee_type', ['full time', 'internship'])->default('full time');
            // department
            $table->string('department')->nullable();
            // position
            $table->string('position')->nullable();
            // face_embedding
            $table->longText('face_embedding')->nullable();
            // image_url
            $table->string('image_url')->nullable();
            // // company_id
            // $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // dropColumn
            $table->dropColumn([
                'phone',
                'role',
                'employeeType',
                'department',
                'position',
                'face_embedding',
                'image_url',
            ]);
        });
    }
};
