<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationApproval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('approval_notify', function (Blueprint $table) {
        $table->engine = "InnoDB";
        $table->increments('id');
        $table->string('message');
        $table->integer('deposit_id');
        $table->integer('user_id');
        $table->integer('status')->default(0);
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
      Schema::dropIfExists('approval_notify');
    }
}
