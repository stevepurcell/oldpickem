<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalty', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('entity_id')->unsigned();
            $table->string('penalty_ind'); 
            $table->string('race_id')->nullable(); 
            $table->integer('points')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('penalty');
    }
}
