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
        //delete is_super_admin column from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_super_admin');
        });
        //add role integer to users table
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //add is_super_admin column to users table
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_super_admin')->default(false);
        });
        //delete role column from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
