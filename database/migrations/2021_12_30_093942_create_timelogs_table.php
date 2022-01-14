<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelogs', function (Blueprint $table) {
            $table->id();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('employe_id');
            $table->index('employe_id', 'employe_id')
                ->foreign('employe_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('timelogs');
    }
}
