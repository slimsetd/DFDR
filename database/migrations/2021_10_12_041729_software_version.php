<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoftwareVersion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('version', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('version');
            $table->text('version_detail');
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => 'VersionTableSeed',
        //     '--force' => true
        //   ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('version');
    }
}
