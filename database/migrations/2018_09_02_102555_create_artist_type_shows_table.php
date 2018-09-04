<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistTypeShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artiste_type_show', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artiste_type_id');
            $table->foreign('artiste_type_id')->references('id')->on('artiste_type')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('show_id');
            $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artiste_type_show');
    }
}
