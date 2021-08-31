<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('in_stock_product_id');
            $table->boolean('cession')->default(false);
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
        Schema::table("phones", function (Blueprint $table) {

            $table->dropForeign("phones_in_stock_product_id_foreign");

        });

        Schema::dropIfExists('phones');
    }
}
