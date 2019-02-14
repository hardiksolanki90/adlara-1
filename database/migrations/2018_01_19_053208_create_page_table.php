<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('content')->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->unsigned()->default(0);
            $table->integer('id_website')->unsigned()->nullable();
            $table->integer('id_lang')->unsigned()->default(1);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        $data = [
          'name' => 'Home Page',
          'content' => 'Hello! Welcome to adlara Application',
          'url' => '/',
          'status' => 1,
          'meta_title' => 'Adlara Application Home page',
          'meta_description' => 'Adlara Application Home page',
          'meta_keywords' => 'Adlara, laravel, application'
        ];
        \Illuminate\Support\Facades\DB::table('page')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page');
    }
}