<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesktopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desktops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('in_stock_product_id');
            $table->string('cpu');
            $table->string('ram');
            $table->string('disk');
            $table->string('vc');
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
        Schema::table("desktops", function (Blueprint $table) {

            $table->dropForeign("desktops_in_stock_product_id_foreign");

        });

        Schema::dropIfExists('desktops');
    }
}
