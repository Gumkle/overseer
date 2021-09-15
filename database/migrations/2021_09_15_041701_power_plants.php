<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PowerPlants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_plants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('own_name')->unique();
            $table->string('producer_id');
            $table->date('installation_date');
            $table->decimal('lon', 10, 7);
            $table->decimal('lat', 10, 7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('power_plants');
    }
}
