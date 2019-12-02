<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_t_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('USE_username', 50);
            $table->char('USE_password', 60);
            $table->char('USE_mail', 180);
            $table->text('USE_ description');
            $table->timestamp('USE_created_at')->nullable();
            $table->timestamp('USE_updated_at')->nullable();
            $table->integer('PIC_id')->nullable();
            $table->integer('SPE_id')->nullable();
            $table->integer('CAM_id')->nullable();
            $table->integer('ROL_id');

            $table->foreign('PIC_id')->references('PIC_id')->on('t_pictures')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('SPE_id')->references('SPE_id')->on('t_specialities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('CAM_id')->references('CAM_id')->on('t_campus')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ROL_id')->references('ROL_id')->on('t_roles')->onDelete('cascade')->onUpdate('cascade');


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
        Schema::dropIfExists('users');
    }
}
