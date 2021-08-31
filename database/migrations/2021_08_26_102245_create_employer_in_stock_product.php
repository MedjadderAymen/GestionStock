<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerInStockProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_in_stock_product', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("in_stock_product_id");
            $table->unsignedBigInteger("employer_id");
            $table->foreign("in_stock_product_id")->references("id")->on("in_stock_products")->onDelete("cascade");
            $table->foreign("employer_id")->references("id")->on("employers")->onDelete("cascade");
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
        Schema::table("employer_in_stock_product", function (Blueprint $table) {

            $table->dropForeign("employer_in_stock_product_in_stock_product_id_foreign");
            $table->dropForeign("employer_in_stock_product_employer_id_foreign");

        });

        Schema::dropIfExists('employer_in_stock_product');
    }
}
