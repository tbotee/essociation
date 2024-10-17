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
        // id, code, amount, model_type, model_id(relation to model)
        Schema::create('water_meter_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index()->nullable();
            $table->smallInteger('order');
            $table->boolean('read_only')->default(false);
            //$table->integer('amount');
            //$table->morphs('model');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_meter_types');
    }
};
