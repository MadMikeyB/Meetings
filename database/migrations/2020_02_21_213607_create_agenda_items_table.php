<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_items', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('day_id');
            $table->uuid('leader_id');
            $table->timestamps();
            $table->integer('type')->comment("See class definition for what the integer means");
            $table->text('name');
            $table->integer('position');
            $table->text('additional');
            $table->integer('expected_number_of_minutes');
            $table->integer('actual_number_of_minutes')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda_items');
    }
}
