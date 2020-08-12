<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLGAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_g_as', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
             $table->string('country');
            $table->string('state');
             $table->string('LGA');
              $table->string('lat')->nullable();
               $table->string('log')->nullable();
                $table->string('population')->nullable();
                 $table->string('area')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_g_as');
    }
}
