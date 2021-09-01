<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->boolean('sap')->default(false);
            $table->string('username')->unique()->nullable();
            $table->string('windows_username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->string('role')->nullable()->default('employer');
            $table->boolean('active')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
