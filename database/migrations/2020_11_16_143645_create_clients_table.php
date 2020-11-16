<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('second_name');
            $table->dateTime('date_register');
            $table->dateTime('last_login');
            $table->string('personal_mobile')->index();
            $table->string('personal_phone')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
