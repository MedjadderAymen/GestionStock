<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("help_desk_id");
            $table->string("serial_number");
            $table->string("provider");
            $table->float("total_price");
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

        Schema::table('invoices',function (Blueprint $blueprint){
           $blueprint->dropForeign('invoices_help_desk_id_foreign');
        });

        Schema::dropIfExists('invoices');
    }
}
