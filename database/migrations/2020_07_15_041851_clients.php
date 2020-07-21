<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('second_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('contacts_telephone');
            $table->string('contacts_email');
            $table->text('description')->nullable();;
            $table->string('company_name');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('user_id')->unsigned()->nullable();
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
