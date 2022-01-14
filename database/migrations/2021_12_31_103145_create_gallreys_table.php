<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGallreysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallreys', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_extension');
            $table->string('file_size');
            $table->string('file_url');
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
        Schema::dropIfExists('gallreys');
    }
}
