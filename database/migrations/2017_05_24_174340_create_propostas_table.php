<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('proposta', 9,2);
            $table->date('data');
            $table->integer('idCarro')->unsigned();
            $table->foreign('idCarro')
                ->references('id')->on('carros')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propostas');
    }
}
