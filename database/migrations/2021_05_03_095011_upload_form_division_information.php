<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UploadFormDivisionInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('upload_form_division', function (Blueprint $table) {
        $table->engine = "InnoDB";
        $table->increments('id');
        $table->string('division');
        $table->integer('upload_form_id')->unsigned();
        $table->foreign('upload_form_id')
              ->references('id')
              ->on('upload_form')
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
      Schema::dropIfExists('upload_form_division');
    }
}
