<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_stocks', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("printer_id");
            $table->string("reference");
            $table->string("color");
            $table->integer("quantity");
            $table->foreign("printer_id")->references("id")->on("printers")->onDelete("cascade");
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
        Schema::table("printer_stocks", function (Blueprint $table) {

            $table->dropForeign("printer_stocks_printer_id_foreign");

        });
        Schema::dropIfExists('printer_stocks');
    }
}
