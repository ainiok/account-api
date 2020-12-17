<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailCaptchasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_captchas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email',128)->index();
            $table->string('code', 6)->index();
            $table->dateTime('expire_at');
            $table->unsignedTinyInteger('times')->default(0);
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
        Schema::dropIfExists('mail_captchas');
    }
}
