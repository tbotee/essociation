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
        // add water meter stats table, id, morph by residence or unit or association, date, value
        Schema::create('water_meter_stats', function (Blueprint $table) {
            $table->id(); // Primary Key

            $table->foreignId('water_meter_id')->constrained()->onDelete('cascade');

            $table->date('date');
            $table->decimal('value', 8, 2);

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_meter_stats');
    }
};
