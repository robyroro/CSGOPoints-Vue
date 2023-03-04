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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_online')->default(0);
            $table->integer('is_blocked')->default(0);
            $table->decimal('points', 11, 3)->default(0);
            $table->decimal('hold_points', 11, 3)->default(0);
            $table->string('steam_id')->default(0);
            $table->string('player_level')->default(0);
            $table->string('avatar')->nullable();
            $table->string('trade_url')->default(0);
            $table->string('joinedIP')->nullable();
            $table->string('lastIP')->nullable();
            $table->timestamp('last_activity')->default(now());
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
