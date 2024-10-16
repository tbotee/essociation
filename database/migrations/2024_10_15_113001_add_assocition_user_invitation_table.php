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
        Schema::create('association_user_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('association_id')->constrained()->onDelete('restrict');
            $table->integer('role_id');
            $table->text('encrypted_data');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('association_user_invitations');
    }
};
