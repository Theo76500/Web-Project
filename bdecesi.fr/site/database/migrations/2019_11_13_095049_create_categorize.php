<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorize', function (Blueprint $table) {
            $table->integer('CAT_id');
            $table->integer('PRO_id');

            $table->foreign('CAT_id')->references('CAT_id')->on('t_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('categorize');
    }
}
