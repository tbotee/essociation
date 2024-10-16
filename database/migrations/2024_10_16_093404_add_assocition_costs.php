<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('association_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('association_id')->constrained()->onDelete('restrict');

            $table->string('name');
            $table->decimal('amount', 10, 2);

            $table->boolean('is_monthly')->default(true);
            $table->date('date')->nullable();

            $table->smallInteger('type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('association_costs');
    }
};
