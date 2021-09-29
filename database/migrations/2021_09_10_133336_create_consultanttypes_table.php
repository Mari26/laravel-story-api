<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultanttypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultanttypes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->bigInteger('consultant_id')->unsigned();
                $table->bigInteger('type_id')->unsigned();
                $table->text('name');
                $table->foreign('consultant_id')->references('id')->on('consultants')->onDelete('cascade');
                $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultanttypes');
    }
}
