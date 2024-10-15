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
        Schema::create('objekts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('website')->nullable();
            $table->enum('category',['KOM', 'HOT', 'PB'])->default('KOM');
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country_code')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->float('total_water_surface')->default(0);
            $table->enum('objekt_type_code',['HB', 'FB', 'HFB', 'DT'])->default('HB');
            $table->integer('order')->default(0);
            $table->text('de_description')->nullable();
            $table->text('en_description')->nullable();
            $table->text('fr_description')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->index('name');
            $table->index('category');
            $table->index('country_code');
            $table->index('postal_code');
            $table->index('city');
            $table->index('total_water_surface');
            $table->index('objekt_type_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objekts');
    }
};
