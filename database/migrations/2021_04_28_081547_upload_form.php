<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UploadForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('upload_form', function (Blueprint $table) {
        $table->engine = "InnoDB";
        $table->increments('id');
        $table->string('title');
        $table->string('category');
        // $table->string('creator');
        // $table->string('subject');
        $table->text('description');
        $table->string('publisher');
        // $table->string('contributor');
        $table->date('date');
        // $table->string('type');
        // $table->string('format');
        // $table->string('identifier');
        // $table->string('source');
        $table->string('language');
        $table->string('relation');
        // $table->string('coverage');
        $table->string('right_management')->default("close");
        // $table->string('division_information');
        // $table->string('file_upload');
        $table->string('status')->default("pending");
        $table->string('upload_for');
        // $table->integer('total_download');
        $table->string('total_download');
        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
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
      Schema::dropIfExists('upload_form');
    }
}
