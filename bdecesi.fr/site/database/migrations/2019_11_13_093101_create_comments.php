<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_comments', function (Blueprint $table) {
            $table->bigIncrements('COM_id');
            $table->text('COM_content');
            $table->timestamp('COM_created_at')->nullable();
            $table->integer('USE_id');
            $table->integer('ACT_id');

            $table->foreign('USE_id')->references('USE_id')->on('t_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ACT_id')->references('ACT_id')->on('t_activities')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('t_comments');
    }
}
