<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('type')->default(config('constants.ownerType.person'))->index();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('cnp')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('cui')->nullable();
            $table->string('company_name')->nullable();
            $table->string('registry_number')->nullable();
            $table->string('email')->nullable();
            $table->smallInteger('ownership_percentage')->default(100);
            $table->foreignId('residence_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
