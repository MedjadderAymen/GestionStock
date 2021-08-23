<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterToner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_toner', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("printer_id");
            $table->unsignedBigInteger("toner_id");
            $table->integer("quantity");
            $table->foreign("printer_id")->references("id")->on("printers")->onDelete("cascade");
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
        Schema::table("printer_toner", function (Blueprint $table) {

            $table->dropForeign("printer_toner_printer_id_foreign");
            $table->dropForeign("printer_toner_toner_id_foreign");

        });

        Schema::dropIfExists('printer_toner');
    }
}
