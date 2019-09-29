<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id');
            $table->string('sender');
            $table->string('sender_name');
            $table->string('img');
            $table->string('to');
            $table->text('subject')->nullable();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->text('message')->nullable();
            $table->boolean('isStarred');
            $table->text('time');
            $table->string('mailType');
            $table->boolean('unread');
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
        Schema::dropIfExists('mails');
    }
}
