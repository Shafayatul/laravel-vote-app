<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('anr')->nullable();;
            $table->string('titel')->nullable();;
            $table->string('vorname');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status')->default(0);
            $table->integer('rolle')->default(0);
            $table->string('firma')->nullable();
            $table->string('form')->nullable();
            $table->string('adresse')->nullable();
            $table->string('plz')->nullable();
            $table->string('ort')->nullable();
            $table->string('bundesland')->nullable();
            $table->string('tel')->nullable();
            $table->string('founded')->nullable();
            $table->string('url')->nullable();
            $table->string('companymail')->nullable();
            $table->string('atu')->nullable();
            $table->string('fb')->nullable();
            $table->integer('first')->default(0);
            $table->integer('agb')->default(0);
            $table->integer('newsletter')->default(0);
            $table->integer('project')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

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
