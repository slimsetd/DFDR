<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('subject', function (Blueprint $table) {
        $table->engine = "InnoDB";
        $table->increments('id');
        $table->string('subject_name');
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
      //   '--class' => 'SubjectTableSeed',
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
      Schema::dropIfExists('subject');
    }
}
