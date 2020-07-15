<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('deal_name')->unique();
            $table->dateTime('open_date');
            $table->dateTime('close_date')->nullable();
            $table->string('deal_descrip')->nullable();
            $table->dateTime('deadline');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('user_id')->unsigned();
            $table->string('status');
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
        Schema::dropIfExists('deals');
    }
}
