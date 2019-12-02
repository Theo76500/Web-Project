<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register', function (Blueprint $table) {
            $table->integer('ACT_id');
            $table->integer('USE_id');



            $table->foreign('ACT_id')->references('ACT_id')->on('t_activities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('USE_id')->references('USE_id')->on('t_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register');
    }
}
