<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_products', function (Blueprint $table) {
            $table->bigIncrements('PRO_id');
            $table->char('PRO_name', 100);
            $table->text('PRO_description');
            $table->decimal('PRO_price', 10,0);
            $table->integer('PRO_quantity');
            $table->integer('PRO_solde')->nullable();
            $table->timestamp('PRO_created_at')->nullable();
            $table->timestamp('PRO_updated_at')->nullable();



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
        Schema::dropIfExists('t_products');
    }
}
