<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ip')->nullable();
            $table->string('sid');
            $table->string('amount');
            $table->string('cname');
            $table->string('status')->nullable();
            $table->string('credit')->nullable();
            $table->string('reverse')->nullable();
            $table->string('passwordVar')->nullable();
            $table->string('password')->nullable();
            $table->string('success')->nullable();
            $table->string('error')->nullable();
            $table->string('hash');
            $table->string('iframe');
            $table->string('wall_image');
            $table->string('color');
            $table->string('logo')->nullable();
            $table->string('boost')->nullable();
            $table->string('unlock')->nullable();
            $table->integer('per')->default(100);
            $table->integer('mulTrack')->default(0);
            $table->string('track')->nullable();
            $table->tinyinteger('active')->default(1);
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
        Schema::dropIfExists('walls');
    }
};
