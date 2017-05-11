<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('folder_id');
            $table->string('folder_name')->nullable();
            $table->string('name');
            $table->string('md5')->nullable();
            $table->string('time')->nullable();
            $table->string('type')->nullable();
            $table->string('troupe')->nullable();
            $table->string('address')->nullable();
            $table->string('actor')->nullable();
            $table->string('drama')->nullable();
            $table->string('size')->nullable();
            $table->string('ext')->nullable();
            $table->string('path')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('files');
    }
}
