<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('answer_id');
            $table->foreign('answer_id')->references('id')->on('answers');
            $table->unsignedBigInteger('ticket_priority_id')->nullable();
            $table->foreign('ticket_priority_id')->references('id')->on('ticket_priorities');
            $table->unsignedBigInteger('ticket_type_id')->nullable();
            $table->foreign('ticket_type_id')->references('id')->on('ticket_types');
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
        Schema::dropIfExists('answer_tickets');
    }
}
