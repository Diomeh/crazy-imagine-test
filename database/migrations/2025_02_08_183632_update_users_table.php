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
            $table->integer('age')->after('email')->nullable();
            $table->date('dob')->after('age')->nullable();
            $table->text('address')->after('dob')->nullable();
            $table->enum('role', ['admin', 'manager'])->after('password')->default('manager');
            $table->string('profile_picture')->after('role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
