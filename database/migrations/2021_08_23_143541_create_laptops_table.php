<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('in_stock_product_id');
            $table->string('cpu');
            $table->string('ram');
            $table->string('disk');
            $table->string('screen');
            $table->string('vc');
            $table->boolean('bag')->default(false);
            $table->foreign('in_stock_product_id')->on('in_stock_products')->references('id')->onDelete('cascade');
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
        Schema::table("laptops", function (Blueprint $table) {

            $table->dropForeign("laptops_in_stock_product_id_foreign");

        });

        Schema::dropIfExists('laptops');
    }
}
