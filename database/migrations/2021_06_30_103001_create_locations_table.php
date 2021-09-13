<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->string('location')->default('default');
            $table->string('location_line_one')->default('default');
            $table->string('location_line_two')->default('default');
            $table->foreign('site_id')->on('sites')->references('id')->onDelete('cascade');
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

        Schema::table('locations', function (Blueprint $blueprint) {

            $blueprint->dropForeign('locations_site_id_foreign');

        });

        Schema::dropIfExists('locations');
    }
}
