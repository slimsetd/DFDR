<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Instruction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('instruction', function (Blueprint $table) {
        $table->engine = "InnoDB";
        $table->increments('id');
        $table->string('instruction_name');
        $table->string('instruction_desc');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      
      Schema::dropIfExists('instruction');
    }
}
