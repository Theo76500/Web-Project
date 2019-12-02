<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompose extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compose', function (Blueprint $table) {
            $table->integer('PRO_id');
            $table->integer('ORD_id');

            $table->foreign('PRO_id')->references('PRO_id')->on('t_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ORD_id')->references('ORD_id')->on('t_orders')->onDelete('cascade')->onUpdate('cascade');


            $table->engine = 'InnoiDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compose');
    }
}
