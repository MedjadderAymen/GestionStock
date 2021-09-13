<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_stock_products', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('employer_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string("zi")->nullable()->unique();
            $table->string("invoice")->nullable()->unique();
            $table->string("class");
            $table->string("constructor");
            $table->string("model");
            $table->string("serial_number");
            $table->boolean("affected");
            $table->string("status");
            $table->string("date_affectation")->nullable();
            $table->foreign("employer_id")->references('id')->on("employers")->onDelete('set null');
            $table->foreign("location_id")->references('id')->on("locations")->onDelete('set null');
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
        Schema::table("in_stock_products", function (Blueprint $table) {

            $table->dropForeign("in_stock_products_employer_id_foreign");
            $table->dropForeign("in_stock_products_location_id_foreign");

        });

        Schema::dropIfExists('in_stock_products');
    }
}
