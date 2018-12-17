<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText('name');
            $table->mediumText('surname');
            $table->string('cell', 30);
            $table->string('eta');
            $table->boolean('breakfast');
            $table->boolean('supper');
            $table->longText('requests');
            $table->datetime('check_in');
            $table->datetime('check_out');
            $table->integer('accompanying');
            $table->decimal('cost_per_night');
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
        Schema::dropIfExists('guest');
    }
}
