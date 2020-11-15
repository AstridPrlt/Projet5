<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_picture')->default('eventsPictures/logoEvent.jpg');
            $table->string('title');
            $table->text('event_description');
            $table->dateTime('event_date_time');
            $table->date('event_date');
            $table->time('begin_time');
            $table->tinyInteger('seats')->unsigned();
            $table->smallInteger('price')->unsigned();
            $table->string('category');
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
        Schema::dropIfExists('events');
    }
}
