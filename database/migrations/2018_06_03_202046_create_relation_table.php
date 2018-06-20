<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idSender')->unsigned();
            $table->integer('idReceived')->unsigned();
            $table->integer('status');
            $table->timestamps();

            //$table->foreign('idSender')->references('id')->on('users');
            //$table->foreign('idReceived')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('relations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
