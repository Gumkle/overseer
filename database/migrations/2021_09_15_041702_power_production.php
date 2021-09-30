<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PowerProduction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_production', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('power_plant_id');
            $table->timestamp('measured_at');
            $table->double('power', $precision = 10, $scale = 3);
            $table->enum('unit', ['Wh', 'kWh', 'MWH', 'GWh']);

            $table->unique(['id', 'measured_at']);
            $table->foreign('power_plant_id')->references('id')->on('power_plants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('power_production');
    }
}
