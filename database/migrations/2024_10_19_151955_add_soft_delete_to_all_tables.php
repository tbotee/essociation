<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'associations',
        'association_users',
        'association_user_invitations',
        'association_costs',
        'owners',
        'residence_user_invitations',
        'residence_users',
        'residences',
        'unit_costs',
        'units',
        'users',
        'water_meter_types',
        'water_meters',
        'cities'
    ];
    public function up(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_tables', function (Blueprint $table) {
            //
        });
    }
};
