<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ready_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('tickets_type_id');
            $table->foreign('tickets_type_id')->references('id')->on('ticket_types');
            $table->softDeletes();
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
        Schema::dropIfExists('ready_answers');
    }
}
