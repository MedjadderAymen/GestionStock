<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceToner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_toner', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("invoice_id");
            $table->unsignedBigInteger("toner_id");
            $table->integer("quantity");
            $table->float("toner_price");
            $table->foreign("invoice_id")->references("id")->on("invoices")->onDelete("cascade");
            $table->foreign("toner_id")->references("id")->on("toners")->onDelete("cascade");
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
        Schema::table("invoice_toner", function (Blueprint $table) {

            $table->dropForeign("invoice_toner_invoice_id_foreign");
            $table->dropForeign("invoice_toner_toner_id_foreign");

        });

        Schema::dropIfExists('invoice_toner');
    }
}
