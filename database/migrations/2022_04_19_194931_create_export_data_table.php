<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('object_count')->default(0);
            $table->integer('project_count')->default(0);
            $table->string('search')->nullable();
            $table->integer('start_year');
            $table->integer('end_year');
            $table->string('category')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            $table->string('objekt_type_code')->nullable();
            $table->string('competence')->nullable();
            $table->string('projekt_type_code')->nullable();
            $table->tinyInteger('competition_pool')->default(0)->nullable();
            $table->string('water_surface_type')->nullable();
            $table->string('water_surface_operator')->default('<');
            $table->string('water_surface_value')->nullable();
            $table->tinyInteger('arge')->default(0)->nullable();
            $table->tinyInteger('ppp')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_data');
    }
};
