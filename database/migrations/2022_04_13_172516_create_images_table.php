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
        Schema::create('images', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->bigInteger('objekt_id');
            $table->bigInteger('projekt_id')->nullable();
            $table->text('description')->nullable();
            $table->string('copyright')->nullable();
            $table->string('web_path');
            $table->string('thumb_path');
            $table->string('orig_path');
            $table->string('extension',50);
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('images');
    }
};
