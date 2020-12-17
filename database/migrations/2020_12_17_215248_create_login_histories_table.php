<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip',15);
            $table->string('platform',16)->nullable();
            $table->string('device',16)->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('user_type',255);
            $table->string('login_name',255);
            $table->string('msg',64);
            $table->boolean('status');
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
        Schema::dropIfExists('login_histories');
    }
}
