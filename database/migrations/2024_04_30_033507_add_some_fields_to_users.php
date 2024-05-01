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
            // company_id
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            // phone
            $table->string('phone')->nullable();
            // role
            $table->string('role')->default('staff');
            // employeeType
            $table->string('employeeType')->default('full time');
            // department
            $table->string('department')->nullable();
            // position
            $table->string('position')->nullable();
            // face_embedding
            $table->text('face_embedding')->nullable();
            // image_url
            $table->string('image_url')->nullable();
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
