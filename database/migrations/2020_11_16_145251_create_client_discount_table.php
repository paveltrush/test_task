<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_discount', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->id('id');

            $table->string('client_id')->index();
            $table->integer('discount_id')->index();

            $table->date('date_activation')->nullable();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');;
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_discount');
    }
}
