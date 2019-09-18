<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->integer('ship_id');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('sailing_start')->nullable();
            $table->dateTime('sailing_end')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('d_day')->nullable();
            $table->dateTime('t_day')->nullable();
            $table->tinyInteger('finished')->nullable();
            $table->string('type')->nullable();
            $table->string('total_fuel')->nullable();
            $table->string('cargo_quantity')->nullable();
            $table->string('cargo')->nullable();
            $table->string('status')->nullable();
            $table->integer('user_id');
            $table->decimal('income', 15,2)->default(0);
            $table->decimal('expense', 15,2)->default(0);
            $table->decimal('profit', 15,2)->default(0);
            $table->integer('duration')->default(0)->nullable();
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
        Schema::dropIfExists('trips');
    }
}
