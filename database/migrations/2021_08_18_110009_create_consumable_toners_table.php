<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableTonersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_toners', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("printer_id");
            $table->unsignedBigInteger("help_desk_id");
            $table->string("reference");
            $table->string("color");
            $table->integer("quantity");
            $table->foreign("printer_id")->references("id")->on("printers")->onDelete("cascade");
            $table->foreign("help_desk_id")->references("id")->on("help_desks")->onDelete("cascade");
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
        Schema::table("consumable_toners", function (Blueprint $table) {

            $table->dropForeign("consumable_toners_printer_id_foreign");
            $table->dropForeign("consumable_toners_help_desk_id_foreign");

        });

        Schema::dropIfExists('consumable_toners');
    }
}
