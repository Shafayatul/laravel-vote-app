<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('count')->nullable();
            $table->string('text',400)->nullable();
            $table->string('ort')->nullable();
            $table->string('hints',400)->nullable();
            $table->string('beschreibung',400)->nullable();
            $table->string('words')->nullable();
            $table->string('extra',400)->nullable();
            $table->string('referenz',200)->nullable();
            $table->string('group')->nullable();
            $table->integer('stat')->default(0);
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
        Schema::dropIfExists('cats');
    }
}
