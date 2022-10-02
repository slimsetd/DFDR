<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('news', function (Blueprint $table) {
        $table->engine = "InnoDB";
        $table->increments('id');
        $table->string('news_title');
        $table->text('news_desc');
        $table->string('news_thumb');
        $table->string('news_thumb_name');
        $table->integer('created_by')->nullable()->unsigned();
        $table->integer('updated_by')->nullable()->unsigned();
        $table->foreign('created_by')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
        $table->foreign('updated_by')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
        $table->timestamps();
      });

      // Artisan::call('db:seed', [
      //   '--class' => 'NewsTableSeed',
      //   '--force' => true
      // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('news');
    }
}
