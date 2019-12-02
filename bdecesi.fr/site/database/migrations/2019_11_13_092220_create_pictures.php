<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePictures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pictures', function (Blueprint $table) {
            $table->bigIncrements('PIC_id');
            $table->char('PIC_name')->default('userdefault');
            $table->timestamp('PIC_created_at')->nullable('2019-11-12 00:22:56');
            $table->timestamp('PIC_updated_at')->nullable('2019-11-12 00:22:56');
            $table->integer('USE_id')->nullable();
            $table->integer('ACT_id')->nullable();
            $table->integer('PRO_id')->nullable();

            $table->foreign('USE_id')->references('USE_id')->on('t_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ACT_id')->references('ACT_id')->on('t_activities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('PRO_id')->references('PRO_id')->on('t_products')->onDelete('cascade')->onUpdate('cascade');


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
        Schema::dropIfExists('t_pictures');
    }
}
