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
        Schema::create('hold_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->string('wall');
            $table->decimal('points',11,3)->default(0);
            $table->string('cname');
            $table->string('track')->nullable;
            $table->timestamp('expires_at');
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
        Schema::dropIfExists('hold_offers');
    }
};
