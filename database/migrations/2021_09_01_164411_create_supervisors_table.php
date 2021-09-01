<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("user_id");
            $table->timestamp('last_logon_time')->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
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

        Schema::table('supervisors', function (Blueprint $blueprint){
            $blueprint->dropForeign("supervisors_user_id_foreign");
        });

        Schema::dropIfExists('supervisors');
    }
}
