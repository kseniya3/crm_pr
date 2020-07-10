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
            $table->id();
            $table->timestamps();
            $table->string('second_name');
            $table->string('first_name');
            $table->string('middle_name');    
            $table->string('contacts');
            $table->text('discription');
            $table->string('company_name');
            /* $table->integer('deal_id')->unsigned();
            $table->foreign('deal_id')->references('id')->on('deal'); */
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
