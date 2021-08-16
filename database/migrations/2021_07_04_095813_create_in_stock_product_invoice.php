<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInStockProductInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_stock_product_invoice', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("invoice_id");
            $table->unsignedBigInteger("in_stock_product_id");
            $table->integer("quantity");
            $table->float("product_price");
            $table->foreign("invoice_id")->references("id")->on("invoices")->onDelete("cascade");
            $table->foreign("in_stock_product_id")->references("id")->on("in_stock_products")->onDelete("cascade");
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

        Schema::table("invoices_in_stock_product", function (Blueprint $table) {

            $table->dropForeign("invoices_in_stock_product_search_invoice_id_foreign");
            $table->dropForeign("invoices_in_stock_product_in_stock_product_id_foreign");

        });

        Schema::dropIfExists('in_stock_product_invoice');
    }
}
