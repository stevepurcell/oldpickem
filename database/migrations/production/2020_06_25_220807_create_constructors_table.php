<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('country_id')->unsigned();
            $table->string('teamchief')->nullable();
            $table->string('technicalchief')->nullable();
            $table->string('chassis')->nullable();
            $table->string('powerunit')->nullable();
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
        Schema::dropIfExists('constructors');
    }
}
