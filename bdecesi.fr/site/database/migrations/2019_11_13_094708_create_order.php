<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->integer('PRO_id');
            $table->integer('USE_id');


            $table->foreign('PRO_id')->references('PRO_id')->on('t_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('USE_id')->references('USE_id')->on('t_users')->onDelete('cascade')->onUpdate('cascade');


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
        Schema::dropIfExists('order');
    }
}
