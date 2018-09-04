<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('slug')->length(60)->unique();
            $table->string('title')->length(255);
            $table->string('poster_url')->length(255)->nullable();
            $table->boolean('bookable');
            $table->decimal('price', 10, 2);

            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')
                ->on('locations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
}
