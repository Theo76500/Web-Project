<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_activities', function (Blueprint $table) {
            $table->bigIncrements('ACT_id');
            $table->char('ACT_name', 100);
            $table->decimal('ACT_price', 10, 0)->nullable();
            $table->text('ACT_description');
            $table->timestamp('ACT_date')->nullable();
            $table->integer('ACT_likes')->nullable();
            $table->char('ACT_likes')->nullable();
            $table->timestamp('ACT_created_at')->nullable();
            $table->timestamp('ACT_updated_at')->nullable();


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
        Schema::dropIfExists('t_activities');
    }
}
