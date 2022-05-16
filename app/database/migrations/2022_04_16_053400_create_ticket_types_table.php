<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('ticket_priority_id')->nullable();
            $table->foreign('ticket_priority_id')->references('id')->on('ticket_priorities');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('tickets_types');
    }
}
