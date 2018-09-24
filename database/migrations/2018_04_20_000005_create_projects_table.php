<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('projektname')->nullable();
            $table->integer('cat_id')->unsigned();
            $table->string('cat_name')->nullable();
            $table->integer('group')->unsigned();
            $table->string('beschreibung')->nullable();
            $table->string('youtube')->nullable();
            $table->string('copyright')->nullable();
            $table->string('testimonial')->nullable();
            $table->string('extra')->nullable();
            $table->integer('check')->default(0);
            $table->string('ort')->nullable();
            $table->integer('stat')->default(0);
            $table->integer('email')->default(0);
            $table->boolean('jury')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('projects', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cat_id')->references('id')->on('cats');

        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
