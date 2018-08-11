<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('filename')->nullable();
            $table->string('url')->nullable();
            $table->string('thumb_url')->nullable();
            $table->string('filesize')->nullable();
            $table->integer('state')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('images', function($table) {
            $table->foreign('project_id')->references('id')->on('projects');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
