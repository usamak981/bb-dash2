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
        Schema::create('projekts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('objekt_id');
            $table->enum('construction',['N', 'S'])->default('N');
            $table->enum('competence',['BEC', 'TGU' ,'GU', 'TOT'])->default('BEC');
            $table->string('projekt_type_code')->nullable();
            $table->integer('total_pools')->default(0);
            $table->enum('material',["1.4404", "1.4462", "1.4547", ""])->default('1.4404');
            $table->float('depth_min')->default(0);
            $table->float('depth_max')->default(0);
            $table->float('length')->default(0);
            $table->float('width')->default(0);
            $table->float('surface')->default(0);
            $table->tinyInteger('arge')->default(0);
            $table->tinyInteger('ppp')->default(0);
            $table->tinyInteger('sports_pool')->default(0);
            $table->integer('start_month')->nullable();
            $table->integer('start_year')->nullable();
            $table->integer('end_month')->nullable();
            $table->integer('end_year')->nullable();
            $table->integer('order')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->index('construction');
            $table->index('competence');
            $table->index('projekt_type_code');
            $table->index('material');
            $table->index('start_year');
            $table->index('sports_pool');
            $table->index('arge');
            $table->index('ppp');
            $table->index('end_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projekts');
    }
};
